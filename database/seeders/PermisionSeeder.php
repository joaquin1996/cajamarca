<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('permisos')->insert([
            'id'            => 1,
            'name'          => 'read',
            'description'   => 'Leer',
        ]);
        DB::table('permisos')->insert([
            'id'            => 2,
            'name'          => 'write',
            'description'   => 'Escribir',
        ]);
        DB::table('permisos')->insert([
            'id'            => 3,
            'name'          => 'edit',
            'description'   => 'Editar',
        ]);
    }
}
