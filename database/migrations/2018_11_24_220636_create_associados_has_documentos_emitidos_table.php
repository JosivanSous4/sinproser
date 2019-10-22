<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAssociadosHasDocumentosEmitidosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('associados_has_documentos_emitidos', function(Blueprint $table)
		{
			$table->integer('associado_id')->index('fk_associados_has_documentos_associados1_idx')->unsigned();
			$table->integer('documento_emitido_id')->index('fk_associados_has_documentos_documentos_emitidos1_idx')->unsigned();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('associados_has_documentos_emitidos');
	}

}
