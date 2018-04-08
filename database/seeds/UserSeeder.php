<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('usuarios')->insert([
            'id'            => '1',
            'name'          => 'Brigdelys Rondón',
            'username'      => 'brigdelys26',
            'email'         => 'brigdelys26@hotmail.com',
            'password'      => bcrypt('123456'),
            'rol'           => 1,
            'path'          => 'brigdelys26.jpg',
            'created_at'    => date('Y-m-d H:m:s'),
            'updated_at'    => date('Y-m-d H:m:s')
        ]);
    }
}
