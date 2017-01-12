<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Bus;

class BusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void   
     */
     public function run()
    {
        DB::table('bus')->delete();

        Bus::create(array(
    	'color'=>'azul',
        'codigo'=>'http://api.thingspeak.com/channels/196276/feed/last.json',
    ));

   
    }
}