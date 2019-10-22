<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEntradasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('entradas', function(Blueprint $table)
		{
			$table->increments('entrada_id');
			$table->string('descricao', 45)->nullable();
			$table->string('pagador', 155)->nullable();
			$table->date('competencia')->nullable();
			$table->dateTime('data_pagamento')->nullable();
			$table->decimal('valor', 10, 2);
			$table->integer('status_id')->unsigned();
			$table->integer('tipo_entrada_id')->index('fk_entradas_tipo_entrada1_idx')->unsigned();
			$table->integer('usuario_criador_id')->nullable();
			$table->integer('recibo_id')->nullable();
			// $table->integer('recibo_id')->index('fk_entradas_recibos1_idx')->unsigned();
			$table->timestamps();
			$table->softDeletes();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('entradas');
	}

}
