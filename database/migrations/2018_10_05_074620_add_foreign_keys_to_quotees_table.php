<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToQuoteesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('quotees', function(Blueprint $table)
		{
			$table->foreign('nationality_id', 'FK_quoteeNationality')->references('id')->on('nationalities')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('profession_id', 'FK_quoteeProfession')->references('id')->on('professions')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('quotees', function(Blueprint $table)
		{
			$table->dropForeign('FK_quoteeNationality');
			$table->dropForeign('FK_quoteeProfession');
		});
	}

}
