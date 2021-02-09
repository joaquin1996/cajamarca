<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersPermisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users_permisos')->insert([
            'id'          => 1,
            'idusers'     => 1,
            'idpermisos'   => 1,
        ]);
        DB::table('users_permisos')->insert([
            'id'          => 2,
            'idusers'     => 1,
            'idpermisos'   => 2,
        ]);
        DB::table('users_permisos')->insert([
            'id'          => 3,
            'idusers'     => 1,
            'idpermisos'   => 3,
        ]);
    }
}
