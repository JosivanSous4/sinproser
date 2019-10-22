<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToEmprestimoBensTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('emprestimos_bens', function(Blueprint $table)
		{
			$table->foreign('responsavel_id', 'fk_emprestimo_bens_responsaveis_emprestimos1')->references('responsavel_id')->on('responsaveis_emprestimos')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('emprestimos_bens', function(Blueprint $table)
		{
			$table->dropForeign('fk_emprestimo_bens_responsaveis_emprestimos1');
		});
	}

}
