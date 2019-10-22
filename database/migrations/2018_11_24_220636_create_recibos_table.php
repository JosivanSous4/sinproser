<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRecibosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('recibos', function(Blueprint $table)
		{
			$table->increments('recibo_id');
			$table->string('nome_receptor')->nullable();
			$table->dateTime('data_emissao');
			$table->text('motivo_emissao', 65535);
			$table->decimal('valor', 10, 2);
			$table->integer('tipo_recibo_id')->index('fk_recibos_tipos_recibo1_idx')->unsigned();
			$table->integer('usuario_emissor_id')->index('fk_recibos_users1_idx')->unsigned();
			$table->timestamps();
			$table->softDeletes();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('recibos');
	}

}
