<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEstadosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if (Schema::hasTable('estados')) {
			Schema::table('estados', function(Blueprint $table)
			{
				
			});
		} else {
			Schema::create('estados', function(Blueprint $table)
			{
				$table->increments('estado_id');
				$table->string('codigo_uf');
				$table->string('estado');
				$table->string('uf');
				$table->string('regiao');

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
		Schema::drop('estados');
	}

}
