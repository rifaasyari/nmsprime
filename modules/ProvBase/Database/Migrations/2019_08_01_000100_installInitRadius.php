<?php

use Illuminate\Database\Schema\Blueprint;

class InstallInitRadius extends BaseMigration
{
    protected $tablename = '';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('modem', function (Blueprint $table) {
            // align with freeradius DB
            $table->string('ppp_username', 64)->default('')->index();
        });

        // use schema from git, since it adds the id column in radusergroup
        \DB::unprepared(file_get_contents('https://raw.githubusercontent.com/FreeRADIUS/freeradius-server/b838f5178fe092598fb3459dedb5e1ea49b41340/raddb/mods-config/sql/main/mysql/schema.sql'));

        foreach (['radacct', 'radcheck', 'radpostauth', 'radreply', 'radusergroup'] as $table) {
            Schema::table($table, function (Blueprint $table) {
                $table->foreign('username')->references('ppp_username')->on('modem')->onDelete('cascade')->onUpdate('cascade');
            });
        }

        $defReply = new Modules\ProvBase\Entities\RadGroupReply;
        $defReply->groupname = $defReply::$defaultGroup;
        $defReply->attribute = 'Acct-Interim-Interval';
        $defReply->op = ':=';
        $defReply->value = 300;
        $defReply->save();

        $config = DB::connection('mysql-radius')->getConfig();

        $find = [
            '/^\s*#*\s*driver\s*=.*/m',
            '/^\s*#*\s*dialect\s*=.*/m',
            '/^\s*#*\s*login\s*=.*/m',
            '/^\s*#*\s*password\s*=.*/m',
            '/^\s*radius_db\s*=.*/m',
            '/^\s*#*\s*read_clients\s*=.*/m',
        ];

        $replace = [
            "\tdriver = \"rlm_sql_mysql\"",
            "\tdialect = \"mysql\"",
            "\tlogin = \"{$config['username']}\"",
            "\tpassword = \"{$config['password']}\"",
            "\tradius_db = \"{$config['database']}\"",
            "\tread_clients = yes",
        ];

        $filename = '/etc/raddb/mods-available/sql';
        $content = file_get_contents($filename);
        $content = preg_replace($find, $replace, $content);
        file_put_contents($filename, $content);

        $link = '/etc/raddb/mods-enabled/sql';
        symlink('/etc/raddb/mods-available/sql', $link);
        // we can't user php chrgp, since it always dereferences symbolic links
        exec("chgrp -h radiusd $link");

        $observer = new Modules\ProvBase\Entities\QosObserver;
        foreach (Modules\ProvBase\Entities\Qos::all() as $qos) {
            $observer->created($qos);
        }

        exec('systemctl enable radiusd.service');
        exec('systemctl start radiusd.service');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
}
