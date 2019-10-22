<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToSindicatoHasContatosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sindicato_has_contatos', function (Blueprint $table) {
            $table->foreign('sindicato_id', 'fk_sindicato_has_contatos_sindicato_id1')->references('sindicato_id')->on('sindicato')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('contato_id', 'fk_sindicato_has_contatos_contato_id1')->references('contato_id')->on('contatos')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sindicato_has_contatos', function (Blueprint $table) {
            $table->dropForeign('fk_sindicato_has_contatos_sindicato_id1');
            $table->dropForeign('fk_sindicato_has_contatos_contato_id1');
        });
    }
}
