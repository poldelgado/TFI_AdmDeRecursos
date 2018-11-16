<?php

use Illuminate\Database\Seeder;

class TechniciansSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('technicians')->insert([
            'cuit' => '21365472289',
            'last_name' => 'Perez',
            'first_name' => 'Juan',
            'phone' => '381123456789',
            'email' => 'jperez@gmail.com',
            'address' => '25 de Mayo 90',
        ]);

        DB::table('technicians')->insert([
            'cuit' => '22365472289',
            'last_name' => 'Gonzalez',
            'first_name' => 'Carlos',
            'phone' => '381572456789',
            'email' => 'cgonzales@gmail.com',
            'address' => 'Mendoza 1810',
        ]);

        DB::table('technicians')->insert([
            'cuit' => '23365472289',
            'last_name' => 'Malena',
            'first_name' => 'Ramirez',
            'phone' => '3814233456789',
            'email' => 'mramirez@gmail.com',
            'address' => 'San Juan 90',
        ]);
    }
}
