<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToAssociadosHasEntradasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('associados_has_entradas', function(Blueprint $table)
		{
			$table->foreign('associado_id', 'fk_associados_has_entradas_associados1')->references('associado_id')->on('associados')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('entrada_id', 'fk_associados_has_entradas_entradas1')->references('entrada_id')->on('entradas')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('associados_has_entradas', function(Blueprint $table)
		{
			$table->dropForeign('fk_associados_has_entradas_associados1');
			$table->dropForeign('fk_associados_has_entradas_entradas1');
		});
	}

}
