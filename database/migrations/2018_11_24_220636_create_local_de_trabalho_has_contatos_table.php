<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLocalDeTrabalhoHasContatosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('local_de_trabalho_has_contatos', function(Blueprint $table)
		{
			$table->integer('local_de_trabalho_id')->index('fk_locais_de_trabalho_has_contatos_locais_de_trabalho1_idx')->unsigned();
			$table->integer('contato_id')->index('fk_locais_de_trabalho_has_contatos_contatos1_idx')->unsigned();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('local_de_trabalho_has_contatos');
	}

}
