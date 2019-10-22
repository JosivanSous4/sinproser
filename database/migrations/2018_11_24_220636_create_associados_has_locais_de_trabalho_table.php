<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAssociadosHasLocaisDeTrabalhoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('associados_has_locais_de_trabalho', function(Blueprint $table)
		{
			$table->increments('associado_local_de_trabalho_id');
			$table->integer('associado_id')->index('fk_associados_has_locais_de_trabalho_associados1_idx')->unsigned();
			$table->integer('local_de_trabalho_id')->index('fk_associados_has_locais_de_trabalho_locais_de_trabalho1_idx')->unsigned();
			$table->string('funcao', 100);
			$table->string('matricula', 45);
			$table->date('data_vinculacao')->nullable();
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
		Schema::drop('associados_has_locais_de_trabalho');
	}

}
