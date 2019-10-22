<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEnderecosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('enderecos', function(Blueprint $table)
		{
			$table->increments('endereco_id');
			$table->string('zona', 100);
			$table->integer('cidade_id')->unsigned();
			$table->string('bairro');
			$table->string('rua');
			$table->string('numero_residencia', 45);
			$table->text('complemento', 65535)->nullable();
			$table->string('cep', 45)->nullable();
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
		Schema::drop('enderecos');
	}

}
