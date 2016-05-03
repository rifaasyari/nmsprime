<?php

namespace Modules\BillingBase\Entities;

use Modules\BillingBase\Entities\Product;
use DB;

class Item extends \BaseModel {

	// The associated SQL table for this Model
	public $table = 'item';

	// Add your validation rules here
	public static function rules($id = null)
	{
		$tariff_prods_o = Product::where('type', '=', 'internet')->orWhere('type', '=', 'tv')->orWhere('type', '=', 'voip')->get();		
		if ($tariff_prods_o->all())
		{
			foreach ($tariff_prods_o as $p)
				$tariff_prods_a[] = $p->id;
			$tariff_ids = implode(',', $tariff_prods_a);
		}
		else 
			$tariff_ids = '';
		
		$credit_prods_o = Product::where('type', '=', 'credit')->get();
		if ($credit_prods_o->all())
		{
			foreach ($credit_prods_o as $p)
				$credit_prods_a[] = $p->id;
			$credit_ids = implode(',', $credit_prods_a);
		}
		else
			$credit_ids = '';


		return array(
			// 'name' => 'required|unique:cmts,hostname,'.$id.',id,deleted_at,NULL'  	// unique: table, column, exception , (where clause)
			'valid_from'	=> 'dateornull',	//|in_future ??
			'valid_to'		=> 'dateornull',
			'credit_amount' => 'required_if:product_id,'.$credit_ids,
			'count'			=> 'null_if:product_id,'.$tariff_ids.','.$credit_ids,
		);
	}


	/**
	 * View related stuff
	 */

	// Name of View
	public static function get_view_header()
	{
		return 'Item';
	}

	// link title in index view
	public function get_view_link_title()
	{
		$start = $end = '';
		if ($this->valid_from != '0000-00-00')
			$start = ' - '.$this->valid_from;
		if ($this->valid_to != '0000-00-00')
			$end = ' - '.$this->valid_to;
		return $this->product->name.$start.$end;
	}

	public function view_belongs_to ()
	{
		return $this->contract;
	}

	/**
	 * Relationships:
	 */

	public function product ()
	{
		return $this->belongsTo('Modules\BillingBase\Entities\Product');
	}

	public function contract ()
	{
		return $this->belongsTo('Modules\ProvBase\Entities\Contract');
	}

	public function costcenter ()
	{
		return $this->belongsTo('Modules\BillingBase\Entities\Costcenter');
	}



	/*
	 * Init Observers
	 */
	public static function boot()
	{
		Item::observe(new ItemObserver);
		parent::boot();
	}



	/*
	 * Billing Stuff with temporary variables used during billing cycle
	 */


	/**
	 * The calculated charge for the customer that has purchased this item (last month is considered)
	 *
	 * @var float
	 */ 
	public $charge;


	/**
	 * The calculated ratio of the items product price (for the last month)
	 *
	 * @var float
	 */ 
	public $ratio;


	/**
	 * The product name and date range the customer is charged for this item
	 *
	 * @var string
	 */ 
	public $invoice_description;



	// /**
	//  * Checks if item has valid dates in last month/year for Billing (dependent on billing cycle)
	//  *
	//  * @return Bool
	//  */
	// public function check_validity($start = '', $end = '', $timespan = null)
	// {
	// 	return parent::check_validity('valid_from', 'valid_to', $this->get_billing_cycle() == 'Yearly' ? 'year' : 'month');
	// }


	// /**
	//  * Checks if item is valid right now
	//  *
	//  * @return Bool 	false, when expired or not yet started - otherwise true
	//  */
	// public function actual_valid()
	// {
	// 	$start = $this->get_start_time();
	// 	$end   = $this->get_end_time();
	// 	$now   = time();

	// 	return $start <= $now && (!$end || $end > $now);
	// }


	/**
	 * Returns time in seconds after 1970 of start of item - Note: valid_from field has higher priority than created_at
	 *
	 * @return integer
	 */
	public function get_start_time()
	{
		$date = $this->valid_from && $this->valid_from != '0000-00-00' ? $this->valid_from : $this->created_at->toDateString();
		return strtotime($date);
		
		// return $this->valid_from && $this->valid_from != '0000-00-00' ? \Carbon\Carbon::createFromFormat('Y-m-d', $this->valid_from) : $this->created_at;
	}


	/**
	 * Returns time in seconds after 1970 of end of item - Note: valid_from field has higher priority than created_at
	 *
	 * @return integer
	 */
	public function get_end_time()
	{
		return $this->valid_to && $this->valid_to != '0000-00-00' ? strtotime($this->valid_to) : null;
	}


	/**
	 * Returns billing cycle
	 *
	 * @return String/Enum 	('Monthly', 'Yearly', 'Quarterly', 'Once')
	 */
	public function get_billing_cycle()
	{
		return $this->billing_cycle ? $this->billing_cycle : $this->product->billing_cycle;
	}

	/**
	 * Returns the assigned Costcenter (CC) by following descendend priorities (1. item CC -> 2. product CC -> 3. contract CC)
	 *
	 * @return object 	Costcenter
	 */
	public function get_costcenter()
	{
		return $this->costcenter ? $this->costcenter : ($this->product->costcenter ? $this->product->costcenter : $this->contract->costcenter);
	}


	/**
	 * Calculate Price for actual month of an item with valid dates - writes it to temporary billing variables of this model
	 *
	 * @param 	array of often used billing dates
	 * @return 	null if no costs incurred, 1 otherwise
	 * @author 	Nino Ryschawy
	 */
	public function calculate_price_and_span($dates)
	{
		$ratio = 0;
		$text  = '';			// only dates
		
		$billing_cycle = $this->get_billing_cycle();
		$start = $this->get_start_time();
		$end   = $this->get_end_time();

		// contract ends before item ends - contract has higher priority
		if ($this->contract->expires)
			$end = !$end || strtotime($this->contract->contract_end) < $end ? strtotime($this->contract->contract_end) : $end;

		
		$overlapping = 0;
		// only 1 internet & voip tariff ! or if they overlap - old tariff has to be charged until new tariff begins
		// TODO: remove && 0
		if ($this->product->type == 'Internet' && 0)
		{
			// get start of valid tariff
			$valid_tariff = $this->contract->get_valid_tariff('Internet');

			if (!$valid_tariff)
				return null;

			// set end date of overlapping tariff
			if ($valid_tariff && $this->id != $valid_tariff->id)
			{
				$end = !$end || $end > $valid_tariff->get_start_time() ? $valid_tariff->get_start_time() : $end;
				$overlapping = 1;
			}
		}


		// only 1 internet & voip tariff ! or if they overlap - old tariff has to be charged until new tariff begins
		if ($this->product->type == 'Voip' && 0)
		{
			// get start of valid tariff
			$valid_tariff = $this->contract->get_valid_tariff('Voip');

			if (!$valid_tariff)
				return null;

			// set end date of overlapping tariff
			if ($valid_tariff && $this->id != $valid_tariff->id)
			{
				$end = !$end || $end > $valid_tariff->get_start_time() ? $valid_tariff->get_start_time() : $end;
				$overlapping = 1;
			}
		}
		

		switch($billing_cycle)
		{
			case 'Monthly':

				// started last month
				if (date('Y-m', $start) == $dates['lastm_Y'])
				{
					$ratio = 1 - (date('d', $start) - 1) / date('t', $start);
					$text  = date('Y-m-d', $start);
				}
				else
				{
					$ratio = 1;
					$text = $dates['lastm_01'];
				}

				$text .= ' - ';

				// ended last month
				if ($end && $end < strtotime($dates['thism_01']))
				{
					$ratio += (date('d', $end) - $overlapping)/date('t', $end) - 1;
					$text  .= date('Y-m-d', $end);
				}
				else
					$text  .= date('Y-m-31', strtotime('last month'));

				break;


			case 'Yearly':

				if ($this->payed)
					break;

				// calculate only for billing month
				$costcenter    = $this->get_costcenter();
				$billing_month = $costcenter->get_billing_month();		// June is default

				if ($dates['m'] != $billing_month)
					break;

				// started last yr
				if (date('Y', $start) == ($dates['Y'] - 1))
				{
					$ratio = 1 - date('z', $start) / (366 + date('L'));		// date('z')+1 is day in year, 365 + 1 for leap year + 1 
					$text  = date('Y-m-d', $start);
				}
				else
				{
					$ratio = 1;
					$text  = date('Y-01-01', strtotime('last year'));
				}

				$text .= ' - ';

				// ended last yr
				if ($end && (date('Y', $end) == ($dates['Y'] - 1)))
				{
					$ratio += $ratio ? (date('z', $end) + 1)/(366 + date('L')) - 1 : 0;
					$text  .= date('Y-m-d', $end);
				}
				else
					$text .= date('Y-12-31', strtotime('last year'));

				// set payed flag to avoid double payment in case of billing month is changed during year
				$this->payed = true;		// is set to false every new year
				$this->save();

				break;

// if ($this->contract->id == 500006 && $this->product->id == 10)
// 	dd($this->product->name, date('Y-m-d', $start), $end, date('Y-m-d', $end), $ratio, $billing_cycle, $text);

			case 'Quarterly':

				// always after 3 months
				$billing_month = date('m', strtotime('+2 month', $start));

				if ($dates['m'] % 3 != $billing_month % 3)
					break;

				$period_start = date('Y-m-01', strtotime('-2 month'));

				// started in last 3 months
				if ($start > strtotime($period_start))
				{
					$days = date('z', strtotime(date('Y-m-31'))) - date('z', $start);
					$total_days = date('t') + date('t', strtotime('last month')) + date('t', $start);
					$ratio = $days / $total_days;
					$text = date('Y-m-d', $start);
				}
				else
				{
					$ratio = 1;
					$text  = $period_start;
				}

				// ended in last 3 months
				if ($end && ($end > strtotime($period_start)) && ($end < strtotime(date('Y-m-01', strtotime('next month')))))
				{
					$days = date('z', strtotime('first day of next month')) - date('z', $end) - 1;
					$total_days = date('t') + date('t', strtotime('last month')) + date('t', $start);
					$ratio -= $days / $total_days;
					$text .= date('Y-m-d', $end);
				}
				else
					$text .= date('Y-m-31');


				// always in second of three months (1 -> 2,5,8,11 2->3,6,9,12 3->4,7,10,1)
				// if (date('m', strtotime('+1 month', $start)) % 3 != $dates['m'] % 3)
				// 	break;

				// $ratio = 1;
				// $end_m = date('m', $end);
				// $n = strtotime('last day of next month');
				// $l = strtotime('first day of last month');

				// // started last month
				// if (date('Y-m', $start) == $dates['lastm_Y'])
				// {
				// 	$days  = date('z', $n) - date('z', $start) + 1;
				// 	$total_days = date('t', $l) + date('t') + date('t', $n);
				// 	$ratio = $days / $total_days;
				// 	$text  = date('Y-m-d', $start);
				// }
				// // started before
				// else
				// 	$text = date('Y-m-01', $l);

				// $text .= ' ';

				// // consider end date - if is during this 3 months
				// if ($end_m == $dates['m'] || $end_m == date('m', $n) || $end_m == date('m', $l))
				// {
				// 	$days  = date('z', $l) - date('z', $end) - 1;
				// 	$total_days = date('t', $l) + date('t') + date('t', $n);
				// 	$ratio -= $days / $total_days;
				// 	$text  .= date('Y-m-d', $end);
				// }
				// else
				// 	$text .= date('Y-m-d', $n);

				break;


			case 'Once':

				$ratio = 1;
				$valid_to = $this->valid_to == $dates['null'] ? null : strtotime(date('Y-m', $this->valid_to));		// only month is considered

				// if payment is split
				if ($valid_to)
				{
					$tot_months = round(($valid_to - strtotime(date('Y-m', $start))) / $dates['m_in_sec'] + 1, 2);
					$ratio /= $tot_months;

					// $part = totm - (to - this)
					$part = round((($tot_months)*$dates['m_in_sec'] + strtotime($dates['lastm_01']) - $valid_to)/$dates['m_in_sec']) + 1;
					$text = " | part $part/$tot_months";

					// items with valid_to in future, but contract expires
					if ($this->contract->expires)
					{
						$ratio *= $tot_months - $part + 1;
						$text  = " | last ".($tot_months-$part+1)." part(s) of $tot_months";
					}
	
				}

				break;

		}

		if (!$ratio)
			return null;

		$this->charge = $this->product->type == 'Credit' ?  (-1) * $this->credit_amount : $this->product->price * $ratio;
		$this->ratio  = $ratio ? $ratio : 1;
		$this->invoice_description = $this->product->name.' '.$text;

		return true;
	}


	/**
	 * Resets the payed flag of all items - flag is necessary because the billing timestamp can be changed
	 */
	public function yearly_conversion()
	{
		DB::table($this->table)->update(['payed' => false]);
	}



}



/**
 * Observer Class
 *
 * can handle   'creating', 'created', 'updating', 'updated',
 *              'deleting', 'deleted', 'saving', 'saved',
 *              'restoring', 'restored',
 */
class ItemObserver
{
	public function creating($item)
	{
		switch ($item->product->type)
		{
			case 'Internet':
			case 'Voip':
			case 'TV':
				if (!$item->valid_from)
					$item->valid_from = date('Y-m-d');
				break;
		}
	}

	public function created($item)
	{
		if ($item->product->type == 'Internet' || $item->product->type == 'Voip')
		{
			// NOTE: keep this order!
			$item->contract->daily_conversion();
			$item->contract->push_to_modems();
		}
	}

	public function updated($item)
	{
		if ($item->product->type == 'Internet' || $item->product->type == 'Voip')
		{
			$item->contract->daily_conversion();
			$item->contract->push_to_modems();
		}
	}

	public function deleted($item)
	{
		if ($item->product->type == 'Internet' || $item->product->type == 'Voip')
		{
			$item->contract->daily_conversion();
			$item->contract->push_to_modems();
		}
	}


}