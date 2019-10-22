<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEmprestimoHasBensTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('emprestimo_has_bens', function(Blueprint $table)
		{
			$table->integer('emprestimo_bem_id')->index('fk_emprestimos_bens_has_bens_emprestimos_bens1_idx')->unsigned();
			$table->integer('bem_id')->index('fk_emprestimos_bens_has_bens_bens1_idx')->unsigned();
			$table->dateTime('data_devolucao')->nullable();
			$table->boolean('bol_devolvido')->nullable();
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
		Schema::drop('emprestimo_has_bens');
	}

}
