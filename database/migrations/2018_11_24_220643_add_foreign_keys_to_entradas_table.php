<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToEntradasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('entradas', function(Blueprint $table)
		{
			// $table->foreign('recibo_id', 'fk_entradas_recibos1')->references('recibo_id')->on('recibos')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('tipo_entrada_id', 'fk_entradas_tipo_entrada1')->references('tipo_entrada_id')->on('tipo_entrada')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			// $table->foreign('usuario_criador_id', 'fk_entradas_users1')->references('user_id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('entradas', function(Blueprint $table)
		{
			// $table->dropForeign('fk_entradas_recibos1');
			$table->dropForeign('fk_entradas_tipo_entrada1');
			// $table->dropForeign('fk_entradas_users1');
		});
	}

}
