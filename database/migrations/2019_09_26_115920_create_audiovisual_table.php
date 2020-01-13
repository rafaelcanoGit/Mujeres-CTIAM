<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAudiovisualTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('audiovisual', function (Blueprint $table) {
            $table->increments('id');
            $table->string("nombre")->unique();
            $table->string("descripcion");
            $table->string("extension");
            $table->string("tipo");
            $table->string("link");
            $table->string("ruta");
            $table->string("rutaPublica");
            $table->timestamps();
           /* $table->collation='utf8mb4_spanish_ci';
            $table->charset='utf8mb4';*/
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('audiovisual');
    }
}
