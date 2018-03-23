<?php

use App\User;
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
        $users = [
            ['name' => 'Francis Yap', 'email' => 'francisyap.utech@gmail.com', 'password' => bcrypt('password')],
        ];

        User::insert($users);
    }
}
