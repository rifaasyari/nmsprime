<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Updater to add flag for products of type internet to be bundled to voip
 *
 * @author Patrick Reichel
 */
class UpdateItemTableForFixedDatesFlags extends BaseMigration {

	// name of the table to create
	protected $tablename = "item";


    /**
	 * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table($this->tablename, function(Blueprint $table) {

			$table->boolean('valid_from_fixed')->after('valid_from')->default(False);
			$table->boolean('valid_to_fixed')->after('valid_to')->default(False);
		});
	}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table($this->tablename, function(Blueprint $table)
		{
			$table->dropColumn([
				'valid_from_fixed',
				'valid_to_fixed',
			]);

        });
    }
}


