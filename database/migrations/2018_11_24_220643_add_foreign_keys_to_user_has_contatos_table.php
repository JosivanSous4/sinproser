<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToUserHasContatosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('user_has_contatos', function(Blueprint $table)
		{
			$table->foreign('contato_id', 'fk_users_has_contatos_contatos1')->references('contato_id')->on('contatos')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('user_id', 'fk_users_has_contatos_users1')->references('user_id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('user_has_contatos', function(Blueprint $table)
		{
			$table->dropForeign('fk_users_has_contatos_contatos1');
			$table->dropForeign('fk_users_has_contatos_users1');
		});
	}

}
