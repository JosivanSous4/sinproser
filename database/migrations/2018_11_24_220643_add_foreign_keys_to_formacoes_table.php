<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToFormacoesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('formacoes', function(Blueprint $table)
		{
			$table->foreign('associado_id', 'fk_associados_has_tipos_formacoes_associados1')->references('associado_id')->on('associados')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('tipo_formacao_id', 'fk_associados_has_tipos_formacoes_tipos_formacoes1')->references('tipo_formacao_id')->on('tipos_formacoes')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('formacoes', function(Blueprint $table)
		{
			$table->dropForeign('fk_associados_has_tipos_formacoes_associados1');
			$table->dropForeign('fk_associados_has_tipos_formacoes_tipos_formacoes1');
		});
	}

}
