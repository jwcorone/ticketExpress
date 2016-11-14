<?php

use Illuminate\Database\Seeder;
use App\User;


class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void   
     */
     public function run()
    {
        DB::table('users')->delete();

        User::create(array(
    	'name'=>'admin2',
        'email'=>'admin2@gmail.com',
        'password' => Hash::make('admin2'),
    ));

    User::create(array(
      'name'=>'estudiante',
        'email'=>'estudiante@gmail.com',
        'password' => Hash::make('estudiante'),
     ));
    }
}
