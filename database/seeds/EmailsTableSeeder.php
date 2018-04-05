<?php

use App\Email;
use Illuminate\Database\Seeder;

class EmailsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $entries = [
            ['profile_id' => '1', 'email' => 'johntest@email.com'],
        ];

        Email::insert($entries);
    }
}
