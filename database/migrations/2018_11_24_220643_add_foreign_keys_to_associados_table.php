<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToAssociadosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('associados', function(Blueprint $table)
		{
			$table->foreign('area_atuacao_id', 'fk_associados_areas_atuacao1')->references('area_atuacao_id')->on('areas_atuacao')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('carteirinha_id', 'fk_associados_carteirinhas1')->references('carteirinha_id')->on('carteirinhas')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('dados_funcionais_id', 'fk_associados_dados_funcionais1')->references('dado_funcional_id')->on('dados_funcionais')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('dados_pessoais_id', 'fk_associados_dados_pessoais1')->references('dados_pessoais_id')->on('dados_pessoais')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('endereco_id', 'fk_associados_enderecos1')->references('endereco_id')->on('enderecos')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('grau_instrucao_id', 'fk_associados_grau_instrucao')->references('grau_instrucao_id')->on('graus_instrucao')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('status_id', 'fk_associados_status1')->references('status_id')->on('status')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('tipo_pagamento_id', 'fk_associados_tipos_pagamento1')->references('tipo_pagamento_id')->on('tipos_pagamento')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('usuario_criador_id', 'fk_associados_users1')->references('user_id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('associados', function(Blueprint $table)
		{
			$table->dropForeign('fk_associados_areas_atuacao1');
			$table->dropForeign('fk_associados_carteirinhas1');
			$table->dropForeign('fk_associados_dados_funcionais1');
			$table->dropForeign('fk_associados_dados_pessoais1');
			$table->dropForeign('fk_associados_enderecos1');
			$table->dropForeign('fk_associados_grau_instrucao');
			$table->dropForeign('fk_associados_status1');
			$table->dropForeign('fk_associados_tipos_pagamento1');
			$table->dropForeign('fk_associados_users1');
		});
	}

}
