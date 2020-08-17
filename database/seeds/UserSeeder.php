<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user           = new User;
        $user->name     = 'Luke';
        $user->email    = 'Luke.skywalker@gmail.com';
        $user->password = bcrypt('demo');
        $user->save();
    }
}
