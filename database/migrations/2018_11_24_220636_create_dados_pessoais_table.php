<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDadosPessoaisTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('dados_pessoais', function(Blueprint $table)
		{
			$table->increments('dados_pessoais_id');
			$table->string('nome');
			$table->string('sexo', 45);
			$table->string('rg', 45);
			$table->date('data_emissao_rg');
			$table->string('orgao_emissor_rg', 45);
			$table->string('cpf', 45);
			$table->string('estado_civil', 45);
			$table->date('data_nascimento');
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
		Schema::drop('dados_pessoais');
	}

}
