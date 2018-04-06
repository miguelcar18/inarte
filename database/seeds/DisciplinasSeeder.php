<?php

use Illuminate\Database\Seeder;

class DisciplinasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('disciplinas')->insert([
            'id'            => '1',
            'nombre'        => 'Danza folklórica',
            'descripcion'   => '',
            'created_at'    => date('Y-m-d H:m:s'),
            'updated_at'    => date('Y-m-d H:m:s')
        ]);
        DB::table('disciplinas')->insert([
            'id'            => '2',
            'nombre'        => 'Danza árabea',
            'descripcion'   => '',
            'created_at'    => date('Y-m-d H:m:s'),
            'updated_at'    => date('Y-m-d H:m:s')
        ]);
        DB::table('disciplinas')->insert([
            'id'            => '3',
            'nombre'        => 'Danza contemporánea',
            'descripcion'   => '',
            'created_at'    => date('Y-m-d H:m:s'),
            'updated_at'    => date('Y-m-d H:m:s')
        ]);
        DB::table('disciplinas')->insert([
            'id'            => '4',
            'nombre'        => 'Hiphop',
            'descripcion'   => '',
            'created_at'    => date('Y-m-d H:m:s'),
            'updated_at'    => date('Y-m-d H:m:s')
        ]);
        DB::table('disciplinas')->insert([
            'id'            => '5',
            'nombre'        => 'Modelaje',
            'descripcion'   => '',
            'created_at'    => date('Y-m-d H:m:s'),
            'updated_at'    => date('Y-m-d H:m:s')
        ]);
        DB::table('disciplinas')->insert([
            'id'            => '6',
            'nombre'        => 'Etiqueta',
            'descripcion'   => '',
            'created_at'    => date('Y-m-d H:m:s'),
            'updated_at'    => date('Y-m-d H:m:s')
        ]);
        DB::table('disciplinas')->insert([
            'id'            => '7',
            'nombre'        => 'Protocolo',
            'descripcion'   => '',
            'created_at'    => date('Y-m-d H:m:s'),
            'updated_at'    => date('Y-m-d H:m:s')
        ]);
        DB::table('disciplinas')->insert([
            'id'            => '8',
            'nombre'        => 'Locución',
            'descripcion'   => '',
            'created_at'    => date('Y-m-d H:m:s'),
            'updated_at'    => date('Y-m-d H:m:s')
        ]);
        DB::table('disciplinas')->insert([
            'id'            => '9',
            'nombre'        => 'Actuación',
            'descripcion'   => '',
            'created_at'    => date('Y-m-d H:m:s'),
            'updated_at'    => date('Y-m-d H:m:s')
        ]);
    }
}
