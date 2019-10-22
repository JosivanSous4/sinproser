<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNoticiasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('noticias', function (Blueprint $table) {
            $table->increments('noticia_id');
            $table->string('titulo');
            $table->string('imagem_capa');
            $table->longText('conteudo');
            $table->text('descricao_rapida');
            $table->boolean('bol_comunicado');
            $table->boolean('bol_destaque');
            $table->boolean('bol_ativo');
            $table->integer('num_views');
            $table->integer('usuario_criador_id')->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('noticias');
    }
}
