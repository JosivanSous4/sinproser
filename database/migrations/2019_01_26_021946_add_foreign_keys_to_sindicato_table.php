<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToSindicatoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sindicato', function (Blueprint $table) {
            $table->foreign('endereco_id', 'fk_sindicato_endereco_id1')->references('endereco_id')->on('enderecos')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sindicato', function (Blueprint $table) {
            $table->dropForeign('fk_sindicato_endereco_id1');
        });
    }
}
