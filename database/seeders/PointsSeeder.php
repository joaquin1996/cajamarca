<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PointsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('points')->insert([
            'id'            => 1,
            'name'          => 'Cajamarca',
            'description'   => 'Cajamarca',
            'lon'           => -78.5236,
            'lat'           => -7.1488,
            'elevation'     => 2720,
            'temp'          => 24,
            'temp_min'      => 24,
            'temp_max'      => 24,
        ]);
        DB::table('points')->insert([
            'id'            => 2,
            'name'          => 'Cajamarca',
            'description'   => 'Cajamarca',
            'lon'           => -78.5171,
            'lat'           => -7.1565,
            'elevation'     => 2720,
            'temp'          => 24,
            'temp_min'      => 24,
            'temp_max'      => 24,
        ]);
        DB::table('points')->insert([
            'id'            => 3,
            'name'          => 'Cajamarca',
            'description'   => 'Cajamarca',
            'lon'           => -78.524901,
            'lat'           => -7.149455,
            'elevation'     => 2720,
            'temp'          => 24,
            'temp_min'      => 24,
            'temp_max'      => 24,
        ]);
        DB::table('points')->insert([
            'id'            => 4,
            'name'          => 'Cajamarca',
            'description'   => 'Cajamarca',
            'lon'           => -78.524901,
            'lat'           => -7.149455,
            'elevation'     => 2730,
            'temp'          => 24,
            'temp_min'      => 24,
            'temp_max'      => 24,
        ]);
        DB::table('points')->insert([
            'id'            => 5,
            'name'          => 'Cajamarca',
            'description'   => 'Cajamarca',
            'lon'           => -78.5224412164728,
            'lat'           => -7.1467809775869995,
            'elevation'     => 2720,
            'temp'          => 24,
            'temp_min'      => 24,
            'temp_max'      => 24,
        ]);
        DB::table('points')->insert([
            'id'            => 6,
            'name'          => 'Cajamarca',
            'description'   => 'Cajamarca',
            'lon'           => -78.524901,
            'lat'           => -7.149455,
            'elevation'     => 2720,
            'temp'          => 24,
            'temp_min'      => 24,
            'temp_max'      => 24,
        ]);
    }
}
