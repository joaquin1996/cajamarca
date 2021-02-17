<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([
            'id'        => 1,
            'name'      => 'admin',
            'email'     => 'admin@admin.com',
            'password'  => bcrypt( 'admin123' ),
            'status'    => 1,
            'idrol'     => 1,
        ]);
    }
}
