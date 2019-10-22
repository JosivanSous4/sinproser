<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDocumentosEmitidosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('documentos_emitidos', function(Blueprint $table)
		{
			$table->increments('documento_emitido_id');
			$table->integer('documento_id')->index('fk_documentos_emitidos_documentos')->unsigned();
			$table->integer('usuario_criador_id')->index('fk_documentos_emitidos_users')->unsigned();
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
		Schema::drop('documentos_emitidos');
	}

}
