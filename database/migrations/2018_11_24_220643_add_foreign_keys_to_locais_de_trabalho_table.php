<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToLocaisDeTrabalhoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('locais_de_trabalho', function(Blueprint $table)
		{
			$table->foreign('endereco_id', 'fk_locais_de_trabalho_enderecos1')->references('endereco_id')->on('enderecos')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('usuario_criador_id', 'fk_locais_de_trabalho_users1')->references('user_id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('locais_de_trabalho', function(Blueprint $table)
		{
			$table->dropForeign('fk_locais_de_trabalho_enderecos1');
			$table->dropForeign('fk_locais_de_trabalho_users1');
		});
	}

}
