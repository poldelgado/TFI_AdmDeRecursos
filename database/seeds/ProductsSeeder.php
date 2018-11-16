<?php

use Illuminate\Database\Seeder;

class ProductsSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('products')->insert([
            'name' => 'Monitor 24"',
            'description' => 'Marca LG'
        ]);

        DB::table('products')->insert([
            'name' => 'Monitor 19"',
            'description' => 'Marca LG'
        ]);

        DB::table('products')->insert([
            'name' => 'Mouse Lazer',
            'description' => 'Marca Genius'
        ]);

        DB::table('products')->insert([
            'name' => 'Teclado"',
            'description' => 'Marca Genius'
        ]);

        DB::table('products')->insert([
            'name' => 'Cable de Red',
            'description' => '-'
        ]);

        DB::table('products')->insert([
            'name' => 'Monitor 19"',
            'description' => 'Marca Samsung'
        ]);

        DB::table('products')->insert([
            'name' => 'Focos Led',
            'description' => 'Marca Philips'
        ]);

        DB::table('products')->insert([
            'name' => 'Ventilador de pie',
            'description' => 'Marca Liliana'
        ]);

        DB::table('products')->insert([
            'name' => 'Monitor 20"',
            'description' => 'Marca LG'
        ]);

        DB::table('products')->insert([
            'name' => 'Felpones para pizarra"',
            'description' => 'Marca Bic'
        ]);

        DB::table('products')->insert([
            'name' => 'Resma de hojas A4',
            'description' => 'Marca Autor'
        ]);

        DB::table('products')->insert([
            'name' => 'Resma de hojas Oficio',
            'description' => 'Marca Autor'
        ]);

        DB::table('products')->insert([
            'name' => 'Impresora Multifunción',
            'description' => 'Marca HP'
        ]);
    }
}
