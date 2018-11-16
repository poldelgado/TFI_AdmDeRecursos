<?php

use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (range(1, 10) as $i) {
            DB::table('users')->insert([
                'name' => str_random(10),
                'email' => str_random(10) . $i .'@frt.utn.edu.ar',
                'admin' => false,
                'password' => bcrypt('1234'),
            ]);
        }
    }
}
