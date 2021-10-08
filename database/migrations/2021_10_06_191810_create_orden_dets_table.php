<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdenDetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orden_dets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('orden_id')->nullable();
            $table->text('producto_descripcion')->nullable();
            $table->integer('cantidad')->nullable();
            $table->char('estado', 1)->nullable();
            $table->foreign('orden_id')->references('id')->on('ordens');
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
        Schema::dropIfExists('orden_dets');
    }
}
