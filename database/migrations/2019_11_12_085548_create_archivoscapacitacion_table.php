<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArchivoscapacitacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('archivoscapacitacion', function (Blueprint $table) {
            $table->increments('id');
            $table->string("nombre")->unique();
            $table->unsignedInteger("capacitacion_id");
           // $table->string("descripcion");
           // $table->string("estado");
            $table->string("extension");
            $table->string("ruta");
            $table->string("rutaPublica");
            $table->timestamps();

            $table->foreign('capacitacion_id')
                  ->references('id')->on('capacitacion');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('archivoscapacitacion');
    }
}
