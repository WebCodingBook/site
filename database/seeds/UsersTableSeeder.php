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
        \WebCoding\Models\User::create([
            'email'     =>  'ribes.alexandre@gmail.com',
            'password'  =>  bcrypt('azerty'),
            'username'  =>  'SquallX'
        ]);
    }
}
