<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToDocumentosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('documentos', function(Blueprint $table)
		{
			$table->foreign('status_id', 'fk_documentos_status1')->references('status_id')->on('status')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('usuario_id', 'fk_documentos_usuario1')->references('user_id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('documentos', function(Blueprint $table)
		{
			$table->dropForeign('fk_documentos_status1');
			$table->dropForeign('fk_documentos_usuario1');
		});
	}

}
