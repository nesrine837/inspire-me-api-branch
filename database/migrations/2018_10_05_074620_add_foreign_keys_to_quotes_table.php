<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToQuotesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('quotes', function(Blueprint $table)
		{
			$table->foreign('category_id', 'FK_quoteCategory')->references('id')->on('categories')->onUpdate('CASCADE')->onDelete('RESTRICT');
			$table->foreign('quotee_id', 'FK_quoteQuotee')->references('id')->on('quotees')->onUpdate('CASCADE')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('quotes', function(Blueprint $table)
		{
			$table->dropForeign('FK_quoteCategory');
			$table->dropForeign('FK_quoteQuotee');
		});
	}

}
