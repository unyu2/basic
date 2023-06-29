<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'	=> 'administrator',
            'email'	=> 'admin@gmail.com',
            'password'	=> bcrypt('123')
    ]);

    }
}
