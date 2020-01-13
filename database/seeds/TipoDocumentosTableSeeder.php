<?php

use Illuminate\Database\Seeder;

class TipoDocumentosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipodocumento')->insert([
            'nombre' => 'Informe Tecnico',
        ]);
        DB::table('tipodocumento')->insert([
            'nombre' => 'Informe de Investigacion',
        ]);
        DB::table('tipodocumento')->insert([
            'nombre' => 'Ponencia',
        ]);
        DB::table('tipodocumento')->insert([
            'nombre' => 'Infografia',
        ]);
        DB::table('tipodocumento')->insert([
            'nombre' => 'Libro',
        ]);
        DB::table('tipodocumento')->insert([
            'nombre' => 'Revista',
        ]);
        DB::table('tipodocumento')->insert([
            'nombre' => 'Otros',
        ]);
    }
}
