<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ActivitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('activities')->insert([
            'id'            => 1,
            'id_category'   => 1,
            'id_point_a'    => 1,
            'id_point_b'    => 2,
            'status'        => 1,
            'name'          => 'Caminata Saludable Cajamarca',
            'description'   => 'Caminata Saludable Cajamarca',
            'icon'          => 'fa-male',
            'distance'      => 1237.51,
            'duration'      => 880.486,
            'dificulty'     => 1,
            'perfil'        => 'pedestrian',
        ]);

        DB::table('activities')->insert([
            'id'            => 2,
            'id_category'   => 2,
            'id_point_a'    => 3,
            'id_point_b'    => 4,
            'status'        => 1,
            'name'          => 'Ciclismo Saludable Cajamarca',
            'description'   => 'Ciclismo Saludable Cajamarca',
            'icon'          => 'fa-bicycle',
            'distance'      => 392.5,
            'duration'      => 115.2,
            'dificulty'     => 2,
            'perfil'        => 'cyclability',
        ]);

        DB::table('activities')->insert([
            'id'            => 3,
            'id_category'   => 2,
            'id_point_a'    => 5,
            'id_point_b'    => 6,
            'status'        => 1,
            'name'          => 'Ciclismo Saludable Cajamarca 2',
            'description'   => 'Ciclismo Saludable Cajamarca 2',
            'icon'          => 'fa-bicycle',
            'distance'      => 513.4,
            'duration'      => 144.8,
            'dificulty'     => 2,
            'perfil'        => 'cyclability',
        ]);

    }
}
