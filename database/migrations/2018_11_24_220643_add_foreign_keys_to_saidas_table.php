<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToSaidasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('saidas', function(Blueprint $table)
		{
			$table->foreign('recibo_id', 'fk_saidas_recibos1')->references('recibo_id')->on('recibos')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('tipo_saida_id', 'fk_saidas_tipos_saida1')->references('tipo_saida_id')->on('tipos_saida')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('usuario_criador_id', 'fk_saidas_users1')->references('user_id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('saidas', function(Blueprint $table)
		{
			$table->dropForeign('fk_saidas_recibos1');
			$table->dropForeign('fk_saidas_tipos_saida1');
			$table->dropForeign('fk_saidas_users1');
		});
	}

}
