<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToAssociadoHasEmprestimosBensTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('associado_has_emprestimos_bens', function(Blueprint $table)
		{
			$table->foreign('associado_id', 'fk_associados_has_emprestimos_bens_associados1')->references('associado_id')->on('associados')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('emprestimo_bem_id', 'fk_associados_has_emprestimos_bens_emprestimos_bens1')->references('emprestimo_bem_id')->on('emprestimos_bens')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('associado_has_emprestimos_bens', function(Blueprint $table)
		{
			$table->dropForeign('fk_associados_has_emprestimos_bens_associados1');
			$table->dropForeign('fk_associados_has_emprestimos_bens_emprestimos_bens1');
		});
	}

}
