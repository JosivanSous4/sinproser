<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBemTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('bens', function(Blueprint $table)
		{
			$table->increments('bem_id');
			$table->date('data_aquisicao');
			$table->integer('produto_id')->index('fk_produto_has_bens_idx')->unsigned();
			$table->integer('status_id')->index('fk_bens_status1_idx')->unsigned();
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('bens');
	}

}
