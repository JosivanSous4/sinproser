<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAssociadoHasEmprestimosBensTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('associado_has_emprestimos_bens', function(Blueprint $table)
		{
			$table->integer('associado_id')->index('fk_associados_has_emprestimos_bens_associados1_idx')->unsigned();
			$table->integer('emprestimo_bem_id')->index('fk_associados_has_emprestimos_bens_emprestimos_bens1_idx')->unsigned();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('associado_has_emprestimos_bens');
	}

}
