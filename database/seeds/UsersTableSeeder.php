<?php
/*
|   Authored/Written/Maintained by:
|       Francis Alec J. Yap
|       francisj.yap@gmail.com
|       https://github.com/francisjyap/socmed
|
*/

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
        $entries = [
            ['name' => 'Francis Yap', 'email' => 'francisyap.utech@gmail.com', 'password' => bcrypt('password'), 'is_admin' => 1],
            ['name' => 'George-Benson Jao', 'email' => 'george.utech@gmail.com', 'password' => '$2y$10$Fqv4reCMeV23M84SElwc5eS5A0zucMeV.eJXyFQinopTFdt0aT3qq', 'is_admin' => 1],
        ];

        User::insert($entries);
    }
}
