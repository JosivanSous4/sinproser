<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUserHasContatosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_has_contatos', function(Blueprint $table)
		{
			$table->integer('user_id')->index('fk_users_has_contatos_users1_idx')->unsigned();
			$table->integer('contato_id')->index('fk_users_has_contatos_contatos1_idx')->unsigned();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('user_has_contatos');
	}

}
