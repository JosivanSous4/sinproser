<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('users', function(Blueprint $table)
		{
			$table->foreign('dados_pessoais_id', 'fk_users_dados_pessoais1')->references('dados_pessoais_id')->on('dados_pessoais')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('perfil_id', 'fk_users_perfis1')->references('perfil_id')->on('perfis')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('users', function(Blueprint $table)
		{
			$table->dropForeign('fk_users_dados_pessoais1');
			$table->dropForeign('fk_users_perfis1');
		});
	}

}
