<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTiposReciboTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tipos_recibo', function(Blueprint $table)
		{
			$table->increments('tipo_recibo_id');
			$table->string('nome', 100);
			$table->string('descricao')->nullable();
			$table->text('template_recibo')->nullable();
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
		Schema::drop('tipos_recibo');
	}

}