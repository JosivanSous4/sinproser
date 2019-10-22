<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToRecibosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('recibos', function(Blueprint $table)
		{
			$table->foreign('tipo_recibo_id', 'fk_recibos_tipos_recibo1')->references('tipo_recibo_id')->on('tipos_recibo')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('usuario_emissor_id', 'fk_recibos_users1')->references('user_id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('recibos', function(Blueprint $table)
		{
			$table->dropForeign('fk_recibos_tipos_recibo1');
			$table->dropForeign('fk_recibos_users1');
		});
	}

}
