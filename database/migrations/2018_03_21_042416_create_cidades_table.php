<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCidadesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if (Schema::hasTable('cidades')) {
			Schema::table('cidades', function(Blueprint $table)
			{

			});
		} else {
			Schema::create('cidades', function(Blueprint $table)
			{
				$table->increments('cidade_id');
				$table->integer('estado_id')->unsigned();
				$table->string('codigo_ibge');
				$table->string('cidade');

				$table->timestamps();
			});
		}
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('cidades');
	}

}
