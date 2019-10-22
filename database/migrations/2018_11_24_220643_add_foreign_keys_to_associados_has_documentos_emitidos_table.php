<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToAssociadosHasDocumentosEmitidosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('associados_has_documentos_emitidos', function(Blueprint $table)
		{
			$table->foreign('associado_id', 'fk_associados_has_documentos_associados1')->references('associado_id')->on('associados')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('documento_emitido_id', 'fk_associados_has_documentos_documentos_emitidos1')->references('documento_emitido_id')->on('documentos_emitidos')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('associados_has_documentos_emitidos', function(Blueprint $table)
		{
			$table->dropForeign('fk_associados_has_documentos_associados1');
			$table->dropForeign('fk_associados_has_documentos_documentos_emitidos1');
		});
	}

}
