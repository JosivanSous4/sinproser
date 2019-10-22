<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSaidasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('saidas', function(Blueprint $table)
		{
			$table->increments('saida_id');
			$table->string('beneficiario');
			$table->text('descricao', 65535);
			$table->date('data_saida');
			$table->decimal('valor', 10, 0);
			$table->integer('tipo_saida_id')->index('fk_saidas_tipos_saida1_idx')->unsigned();
			$table->integer('usuario_criador_id')->index('fk_saidas_users1_idx')->unsigned();
			$table->integer('recibo_id')->index('fk_saidas_recibos1_idx')->unsigned();
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
		Schema::drop('saidas');
	}

}
