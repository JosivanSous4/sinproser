<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToResponsavelContatosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('responsavel_contatos', function (Blueprint $table) {
            $table->foreign('responsavel_id', 'fk_responsavel_contatos_responsavel1')->references('responsavel_id')->on('responsaveis_emprestimos')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('contato_id', 'fk_responsavel_contatos1')->references('contato_id')->on('contatos')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('responsavel_contatos', function (Blueprint $table) {
            $table->dropForeign('fk_responsavel_contatos_responsavel1');
            $table->dropForeign('fk_responsavel_contatos1');
        });
    }
}
