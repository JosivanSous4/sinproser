<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDadosFuncionaisTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('dados_funcionais', function(Blueprint $table)
		{
			$table->increments('dado_funcional_id');
			$table->date('data_admissao');
			$table->string('pis_pasep');
			$table->string('portaria');
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('dados_funcionais');
	}

}
