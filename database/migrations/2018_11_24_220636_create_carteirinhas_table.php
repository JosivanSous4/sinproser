<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCarteirinhasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('carteirinhas', function(Blueprint $table)
		{
			$table->increments('carteirinha_id');
			$table->date('data_emissao');
			$table->boolean('bol_impresso')->default(false);
			$table->boolean('bol_segunda_via')->default(false);
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
		Schema::drop('carteirinhas');
	}

}
