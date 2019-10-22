<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToAssociadoHasContatosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('associado_has_contatos', function(Blueprint $table)
		{
			$table->foreign('associado_id', 'fk_associados_has_contatos_associados1')->references('associado_id')->on('associados')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('contato_id', 'fk_associados_has_contatos_contatos1')->references('contato_id')->on('contatos')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('associado_has_contatos', function(Blueprint $table)
		{
			$table->dropForeign('fk_associados_has_contatos_associados1');
			$table->dropForeign('fk_associados_has_contatos_contatos1');
		});
	}

}
