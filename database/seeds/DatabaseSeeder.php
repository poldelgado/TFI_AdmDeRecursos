<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $this->call([
             UsersSeeder::class,
             ProductsSeeder::class,
             ProvidersSeeder::class,
             TechniciansSeeder::class,
             PurchaseOrdersSeeder::class
         ]);
    }
}
