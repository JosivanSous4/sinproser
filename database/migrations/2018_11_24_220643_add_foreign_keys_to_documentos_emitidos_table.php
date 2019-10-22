<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToDocumentosEmitidosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('documentos_emitidos', function(Blueprint $table)
		{
			$table->foreign('documento_id', 'fk_documentos_emitidos_documentos')->references('documento_id')->on('documentos')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('usuario_criador_id', 'fk_documentos_emitidos_users')->references('user_id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('documentos_emitidos', function(Blueprint $table)
		{
			$table->dropForeign('fk_documentos_emitidos_documentos');
			$table->dropForeign('fk_documentos_emitidos_users');
		});
	}

}
