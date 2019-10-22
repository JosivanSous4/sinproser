<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToParceirosHasContatosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('parceiro_has_contatos', function (Blueprint $table) {
            $table->foreign('parceiro_id', 'fk_parceiro_has_contatos_parceiro_id1')->references('parceiro_id')->on('parceiros')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('contato_id', 'fk_parceiro_has_contatos_contato_id1')->references('contato_id')->on('contatos')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('parceiro_has_contatos', function (Blueprint $table) {
            $table->dropForeign('fk_parceiro_has_contatos_parceiro_id1');
            $table->dropForeign('fk_parceiro_has_contatos_contato_id1');
        });
    }
}
