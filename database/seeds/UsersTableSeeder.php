<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \App\User::create([
            'name'=> 'Afdrian Juarlin',
            'username'=> 'afdrianj',
            'password'=> bcrypt('afdrianj'),
            'email'=> 'afdrian@gmail.com',
        ]);
    }
}
