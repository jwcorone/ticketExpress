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
        // $this->call(UserTableSeeder::class);
        Eloquent::unguard();
        $this->call(UserTableSeeder::class);
        $this->call(RutasTableSeeder::class);
        $this->call(HorariosTableSeeder::class);
        $this->call(BusTableSeeder::class);

        
    }
}
