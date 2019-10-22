<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAreasAtuacaoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('areas_atuacao', function(Blueprint $table)
		{
			$table->increments('area_atuacao_id', true);
			$table->string('nome');
			$table->string('dia_previsto_pagamento');
			$table->text('descricao', 65535)->nullable();
			$table->integer('usuario_criador_id')->unsigned();
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
		Schema::drop('areas_atuacao');
	}

}
