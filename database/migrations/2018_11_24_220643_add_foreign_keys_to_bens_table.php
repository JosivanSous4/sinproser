<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToBensTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('bens', function(Blueprint $table)
		{
			$table->foreign('produto_id', 'fk_produto_bens1')->references('produto_id')->on('produtos')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('status_id', 'fk_bens_status1')->references('status_id')->on('status')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('bens', function(Blueprint $table)
		{
			$table->dropForeign('fk_produto_bens1');
			$table->dropForeign('fk_bens_status1');
		});
	}

}
