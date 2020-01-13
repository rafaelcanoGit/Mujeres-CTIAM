<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */

    public function run()
    {
        $this->truncateTables([
            'tipousuario',
            'tipodocumento',
            //'users'
        ]);
        $this->call(TipoUsersTableSeeder::class);
        $this->call(TipoDocumentosTableSeeder::class);
        //$this->call(UsersTableSeeder::class);
        
    }

    protected function truncateTables(array $tablas){
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        foreach($tablas as $tabla){
            DB::table($tabla)->truncate();
        }
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
    }
}
