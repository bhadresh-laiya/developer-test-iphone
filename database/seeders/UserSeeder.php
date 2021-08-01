<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        User::create([

            'name' => 'Bhadresh',

            'email' => 'admin@gmail.com',

            'password' => bcrypt('123456'),

        ], [
            'name' => 'John',

            'email' => 'john@gmail.com',

            'password' => bcrypt('987654'),
        ]);
    }
}
