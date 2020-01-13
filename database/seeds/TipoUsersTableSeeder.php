<?php

use Illuminate\Database\Seeder;

class TipoUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('tipousuario')->insert([
            'nombre' => 'Ama de casa',
        ]);
        DB::table('tipousuario')->insert([
            'nombre' => 'Emprendedora',
        ]);
        DB::table('tipousuario')->insert([
            'nombre' => 'Profesional',
        ]);
        DB::table('tipousuario')->insert([
            'nombre' => 'Estudiante',
        ]);
    }
}
