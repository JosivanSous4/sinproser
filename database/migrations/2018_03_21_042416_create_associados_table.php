<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAssociadosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('associados', function(Blueprint $table)
		{
			$table->increments('associado_id');
			$table->date('data_associacao')->nullable();
			$table->string('foto')->nullable();
			$table->boolean('bool_professor')->default(0);
			$table->boolean('bol_presidente')->default(0);
			$table->boolean('bol_inadimplente');
			$table->integer('grau_instrucao_id')->index('fk_associados_grau_instrucao_idx')->unsigned();
			$table->integer('dados_funcionais_id')->index('fk_associados_dados_funcionais1_idx')->unsigned();
			$table->integer('tipo_pagamento_id')->index('fk_associados_tipos_pagamento1_idx')->unsigned();
			$table->integer('endereco_id')->index('fk_associados_enderecos1_idx')->unsigned();
			$table->integer('area_atuacao_id')->index('fk_associados_areas_atuacao1_idx')->unsigned();
			$table->decimal('salario', 10,2);
			$table->integer('dados_pessoais_id')->index('fk_associados_dados_pessoais1_idx')->unsigned();
			$table->integer('carteirinha_id')->index('fk_associados_carteirinhas1_idx')->nullable()->unsigned();
			$table->integer('status_id')->index('fk_associados_status1_idx')->unsigned();
			$table->integer('usuario_criador_id')->index('fk_associados_users1_idx')->unsigned();
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
		Schema::drop('associados');
	}

}
