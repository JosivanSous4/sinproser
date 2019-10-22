<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateResponsavelEmprestimoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('responsaveis_emprestimos', function(Blueprint $table)
		{
			$table->increments('responsavel_id');
			$table->string('nome_responsavel');
			$table->string('cpf_responsavel', 15);
			$table->integer('endereco_id')->unsigned();
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
		Schema::drop('responsaveis_emprestimos');
	}

}
