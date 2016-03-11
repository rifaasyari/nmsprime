<?php

namespace Modules\BillingBase\Entities;

use Modules\BillingBase\Entities\Price;

class Item extends \BaseModel {

	// The associated SQL table for this Model
	public $table = 'item';

	// Add your validation rules here
	public static function rules($id = null)
	{
		return array(
			// 'hostname' => 'required|unique:cmts,hostname,'.$id.',id,deleted_at,NULL'  	// unique: table, column, exception , (where clause)
			// 'payment_to' => 'date' //'dateFormat:yyyy-mm-dd'
			// 'payment_from' => 'required_with:payment_to', //'dateFormat:yyyy-mm-dd'
			'credit_amount' => 'min:0'
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
		return Price::find($this->price_id)->name;
		return Price::find($this->price_id)->name.' | '.$this->payment_from.' - '.$this->payment_to;
	}

	public function view_belongs_to ()
	{
		return $this->contract;
	}

	/**
	 * Relationships:
	 */

	public function price ()
	{
		return $this->belongsTo('Modules\BillingBase\Entities\Price');
	}

	public function contract ()
	{
		return $this->belongsTo('Modules\ProvBase\Entities\Contract');
	}

}