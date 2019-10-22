<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEmprestimosBensTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('emprestimos_bens', function(Blueprint $table)
		{
			$table->increments('emprestimo_bem_id');
			$table->integer('responsavel_id')->unsigned();
			$table->date('data_devolucao')->nullable();
			$table->date('data_prevista_devolucao')->nullable();
			$table->boolean('bol_devolvido')->nullable();
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
		Schema::drop('emprestimos_bens');
	}

}
