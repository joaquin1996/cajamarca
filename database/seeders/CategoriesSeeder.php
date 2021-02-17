<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            'id'            => 1,
            'name'          => 'Senderismo',
            'description'   => 'Senderismo',
            'icon'          => 'fa-male',
            'place'         => 1,
            'status'        => 1,
        ]);
        DB::table('categories')->insert([
            'id'            => 2,
            'name'          => 'Escalada',
            'description'   => 'Escalada',
            'icon'          => 'fa-male',
            'place'         => 1,
            'status'        => 1,
        ]);
        DB::table('categories')->insert([
            'id'            => 3,
            'name'          => 'Barranquismo',
            'description'   => 'Barranquismo',
            'icon'          => 'fa-male',
            'place'         => 1,
            'status'        => 1,
        ]);
        DB::table('categories')->insert([
            'id'            => 4,
            'name'          => 'Vías Ferratas',
            'description'   => 'Vías Ferratas',
            'icon'          => 'fa-male',
            'place'         => 1,
            'status'        => 1,
        ]);
        DB::table('categories')->insert([
            'id'            => 5,
            'name'          => 'BTT',
            'description'   => 'BTT',
            'icon'          => 'fa-male',
            'place'         => 1,
            'status'        => 1,
        ]);
        DB::table('categories')->insert([
            'id'            => 6,
            'name'          => 'Ciclo Turismo',
            'description'   => 'Ciclo Turismo',
            'icon'          => 'fa-bicycle',
            'place'         => 1,
            'status'        => 1,
        ]);
    }
}
