<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToResponsavelEmprestimoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('responsaveis_emprestimos', function(Blueprint $table)
		{
			$table->foreign('endereco_id', 'fk_responsaveis_emprestimos_enderecos1')->references('endereco_id')->on('enderecos')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('responsaveis_emprestimos', function(Blueprint $table)
		{
			$table->dropForeign('fk_responsaveis_emprestimos_enderecos1');
		});
	}

}
