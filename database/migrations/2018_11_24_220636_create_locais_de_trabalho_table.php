<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLocaisDeTrabalhoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('locais_de_trabalho', function(Blueprint $table)
		{
			$table->increments('local_de_trabalho_id');
			$table->string('nome');
			$table->string('descricao', 45)->nullable();
			$table->integer('endereco_id')->index('fk_locais_de_trabalho_enderecos1_idx')->nullable()->unsigned();
			$table->integer('usuario_criador_id')->index('fk_locais_de_trabalho_users1_idx')->unsigned();
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
		Schema::drop('locais_de_trabalho');
	}

}
