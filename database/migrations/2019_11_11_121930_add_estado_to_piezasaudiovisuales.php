<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddEstadoToPiezasaudiovisuales extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('audiovisual', function(Blueprint $table) {
            $table->string('estado')->after('descripcion');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('audiovisual', function (Blueprint $table) {
            $table->dropColumn('estado');
        });
    }
}
