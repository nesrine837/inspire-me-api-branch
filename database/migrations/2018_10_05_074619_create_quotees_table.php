<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateQuoteesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('quotees', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('quotee_name', 100)->unique('Uniqueentries');
			$table->text('biography_link', 65535)->nullable();
			$table->integer('profession_id')->index('FK_quoteeProfession');
			$table->integer('nationality_id')->index('FK_quoteeNationality');
			$table->string('quotee_gender', 1)->default('m');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('quotees');
	}

}
