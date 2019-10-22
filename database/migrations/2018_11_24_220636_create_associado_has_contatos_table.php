<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAssociadoHasContatosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('associado_has_contatos', function(Blueprint $table)
		{
			$table->integer('associado_id')->index('fk_associados_has_contatos_associados1_idx')->unsigned();
			$table->integer('contato_id')->index('fk_associados_has_contatos_contatos1_idx')->unsigned();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('associado_has_contatos');
	}

}
