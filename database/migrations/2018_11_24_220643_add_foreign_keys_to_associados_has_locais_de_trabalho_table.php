<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToAssociadosHasLocaisDeTrabalhoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('associados_has_locais_de_trabalho', function(Blueprint $table)
		{
			$table->foreign('associado_id', 'fk_associados_has_locais_de_trabalho_associados1')->references('associado_id')->on('associados')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('local_de_trabalho_id', 'fk_associados_has_locais_de_trabalho_locais_de_trabalho1')->references('local_de_trabalho_id')->on('locais_de_trabalho')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('associados_has_locais_de_trabalho', function(Blueprint $table)
		{
			$table->dropForeign('fk_associados_has_locais_de_trabalho_associados1');
			$table->dropForeign('fk_associados_has_locais_de_trabalho_locais_de_trabalho1');
		});
	}

}
