<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAssociadosHasEntradasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('associados_has_entradas', function(Blueprint $table)
		{
			$table->integer('associado_id')->index('fk_associados_has_entradas_associados1_idx')->unsigned();
			$table->integer('entrada_id')->index('fk_associados_has_entradas_entradas1_idx')->unsigned();
			$table->date('data_repasse')->nullable();
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
		Schema::drop('associados_has_entradas');
	}

}
