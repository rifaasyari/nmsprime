<?php

namespace Modules\provbase\Console;

use Carbon\Carbon;
use http\Client;
use Illuminate\Console\Command;
use Modules\ProvVoip\Entities\Mta;
use Modules\ProvBase\Entities\Cmts;
use Modules\ProvBase\Entities\Modem;
use Modules\ProvBase\Entities\Endpoint;
use Modules\ProvBase\Entities\ProvBase;

class HardwareSupportCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'nms:hardware-support';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'checks for hardware support of each modem and CMTS';

    protected $domain_name = '';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->domain_name = ProvBase::first()->domain_name;
        parent::__construct();
    }

    /**
     * Execute the console command - Check for hardware support for each modem and each CMTS modules
     *
     * @return mixed
     */
    public function fire()
    {

        $this->snmp_def_mode();
        $modems = Modem::all();
        $cmtses = Cmts::all();
        $ro_community = ProvBase::first()->ro_community;

        foreach ($modems as $modem) {
            $hostname = $modem->hostname.'.'.$this->domain_name;
            $support_state = 'not-supported';
            if($modem->serial_num !== ''){
                //TODO: check the response on a live system, not tested on a fully integrated system
                $modem->serial_num = snmpget($hostname, $ro_community, '1.3.6.1.2.1.69.1.1.4.0');
            }
            $modem_serial_no_md5 = md5($modem->serial_num);
            $contents = file_get_contents('https://support.nmsprime.com/hwsn/api.php?q='.$modem_serial_no_md5);

            if ($contents !== '') {
                $result = json_decode($contents, true);
                if (isset($result[$modem_serial_no_md5]) && $result[$modem_serial_no_md5] === 'valid') {
                    $support_state = 'full-support';
                } else if ($modem->created_at->diffInWeeks(Carbon::now()) < 6) {
                    $support_state = 'verifying';
                }
            }

            $modem->support_state = $support_state;
            $modem->save();
        }

        foreach ($cmtses as $cmts) {
            $hostname = $modem->hostname.'.'.$this->domain_name;
            $support_state = 'not-supported';

            //TODO: Test snmpwalk response a live system, not tested on a fully integrated system
            $cmts_serials = snmpwalk($hostname, $ro_community, '1.3.6.1.2.1.47.1.1.1.1.11');
            $count_found = 0;
            foreach ($cmts_serials as $cmts_serial){

                $cmts_serial_md5 = md5($cmts_serial);
                $contents = file_get_contents('https://support.nmsprime.com/hwsn/api.php?q='.$cmts_serial_md5);

                if ($contents !== '') {
                    $result = json_decode($contents, true);
                    if (isset($result[$cmts_serial_md5]) && $result[$cmts_serial_md5] === 'valid') {
                        $count_found++;
                    }
                }
            }

            if($count_found){
                switch ($percentage = $count_found/count($cmts_serials)*100){
                    case $percentage > 80 && $percentage <=95:
                        $support_state = 'restricted';
                        break;
                    case $percentage > 95:
                        $support_state = 'full-supported';
                        break;
                    case $cmts->created_at->diffInWeeks(Carbon::now()) < 6:
                        $support_state = 'verifying';
                }
            }
        }
        $cmts->support_state = $support_state;
        $cmts->save();

    }

    /**
     * Set PHP SNMP Default Values
     * Note: Must be only called once per Object Init
     *
     * Note: copied from SnmpController
     *
     */
    private function snmp_def_mode()
    {
        snmp_set_quick_print(true);
        snmp_set_oid_numeric_print(true);
        snmp_set_valueretrieval(SNMP_VALUE_PLAIN);
        snmp_set_oid_output_format(SNMP_OID_OUTPUT_NUMERIC);
    }
}
