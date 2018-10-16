<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateQuotesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('quotes', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->text('quote_content', 65535);
			$table->integer('quotee_id')->index('FK_quoteQuotee');
			$table->integer('category_id')->default(13)->index('FK_quoteCategory');
			$table->text('keywords', 65535)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('quotes');
	}

}
