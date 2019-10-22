<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToEmprestimoHasBensTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('emprestimo_has_bens', function(Blueprint $table)
		{
			$table->foreign('bem_id', 'fk_emprestimos_bens_has_bens_bens1')->references('bem_id')->on('bens')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('emprestimo_bem_id', 'fk_emprestimos_bens_has_bens_emprestimos_bens1')->references('emprestimo_bem_id')->on('emprestimos_bens')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('emprestimo_has_bens', function(Blueprint $table)
		{
			$table->dropForeign('fk_emprestimos_bens_has_bens_bens1');
			$table->dropForeign('fk_emprestimos_bens_has_bens_emprestimos_bens1');
		});
	}

}
