<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class PlacesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('places')->insert([
            'id'            => 1,
            'name'          => 'Cajamarca',
            'description'   => 'Cajamarca',
            'status'        => 1,
        ]);
    }
}
