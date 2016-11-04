<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Permissao extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('permissoes', function (Blueprint $table) {
        $table->increments('id');
        $table->string('name')->unique();
        $table->string('display_name')->nullable();
        $table->string('description')->nullable();
        $table->timestamps();

      });


      Schema::create('permissoes_cargo', function (Blueprint $table) {
          $table->integer('permissoes_id')->unsigned();
          $table->integer('cargos_id')->unsigned();
          $table->foreign('permissoes_id')->references('id')->on('permissoes')
              ->onUpdate('cascade')->onDelete('cascade');
          $table->foreign('cargos_id')->references('id')->on('cargos')
              ->onUpdate('cascade')->onDelete('cascade');
          $table->primary(['permissoes_id', 'cargos_id']);
    });
  }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
