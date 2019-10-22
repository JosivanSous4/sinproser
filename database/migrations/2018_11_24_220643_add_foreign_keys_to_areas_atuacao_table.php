<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToAreasAtuacaoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('areas_atuacao', function(Blueprint $table)
		{
			$table->foreign('usuario_criador_id', 'fk_area_atuacao_user1')->references('user_id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('areas_atuacao', function(Blueprint $table)
		{
			$table->dropForeign('fk_area_atuacao_user1');
		});
	}

}
