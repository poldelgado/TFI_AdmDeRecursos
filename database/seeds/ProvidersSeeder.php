<?php

use Illuminate\Database\Seeder;

class ProvidersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('providers')->insert([
            'cuit' => '21365472289',
            'name' => 'Perez SRL',
            'phone' => '381123456789',
            'email' => 'perez@gmail.com',
            'address' => '25 de Mayo 500',
        ]);

        DB::table('providers')->insert([
            'cuit' => '22365472289',
            'name' => 'AJP SA',
            'phone' => '381572456789',
            'email' => 'ajp_servicios@gmail.com',
            'address' => 'Mendoza 20',
        ]);

        DB::table('providers')->insert([
            'cuit' => '23365472289',
            'name' => 'PS Informática',
            'phone' => '3814233456789',
            'email' => 'psinformatica@gmail.com',
            'address' => 'San Juan 800',
        ]);
    }
}
