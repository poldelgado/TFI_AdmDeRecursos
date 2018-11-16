<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class PurchaseOrdersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        foreach (range(1, 100) as $i) {
            DB::table('purchase_orders')->insert([
                'date_order' => $faker->date($format = 'Y-m-d', $max = 'now'),
                'total' => $faker->randomFloat($nbMaxDecimals = NULL, $min = 0, $max = 10000.00),
                'product_id' => $faker->randomElement($array = [1,2,3,4,5,6,7,8,9,10,11,12,13]),
                'provider_id' => $faker->randomElement($array = [1,2,3]),
                'warranty_void' => $faker->randomDigit,
            ]);
        }
    }
}
