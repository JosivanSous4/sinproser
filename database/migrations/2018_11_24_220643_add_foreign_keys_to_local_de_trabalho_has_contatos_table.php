<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToLocalDeTrabalhoHasContatosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('local_de_trabalho_has_contatos', function(Blueprint $table)
		{
			$table->foreign('contato_id', 'fk_locais_de_trabalho_has_contatos_contatos1')->references('contato_id')->on('contatos')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('local_de_trabalho_id', 'fk_locais_de_trabalho_has_contatos_locais_de_trabalho1')->references('local_de_trabalho_id')->on('locais_de_trabalho')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('local_de_trabalho_has_contatos', function(Blueprint $table)
		{
			$table->dropForeign('fk_locais_de_trabalho_has_contatos_contatos1');
			$table->dropForeign('fk_locais_de_trabalho_has_contatos_locais_de_trabalho1');
		});
	}

}
