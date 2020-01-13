<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVistasVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vistas_videos', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_audiovisual');
            $table->string('tipo_accion');
            $table->string('tipo_archivo');
            $table->timestamps();

            $table->foreign('id_audiovisual')->references('id')->on('audiovisual');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vistas_videos');
    }
}
