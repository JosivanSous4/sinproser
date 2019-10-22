<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFormacoesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('formacoes', function(Blueprint $table)
		{	
			$table->increments('formacao_id');
			$table->integer('associado_id')->index('fk_associados_has_tipos_formacoes_associados1_idx')->unsigned();
			$table->integer('tipo_formacao_id')->index('fk_associados_has_tipos_formacoes_tipos_formacoes1_idx')->unsigned();
			$table->string('formacao');
			$table->string('situacao_formacao');
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
		Schema::drop('formacoes');
	}

}
