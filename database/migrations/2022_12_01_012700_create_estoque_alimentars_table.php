<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEstoqueAlimentarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estoque_alimentars', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('codigo');
            $table->string('categoria');
            $table->string('nome');
            $table->string('descricao');
            $table->integer('estoque');
            $table->integer('estoqueMin');
            $table->integer('estoqueMax');
            $table->string('unidade');
            $table->string('fornecedor');
            $table->decimal('lucro',10,2);
            $table->decimal('preco_custo',10,2);
            $table->decimal('preco',10,2);
            $table->index(['codigo']);
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
        Schema::dropIfExists('estoque_alimentars');
    }
}
