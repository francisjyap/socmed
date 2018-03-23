<?php

use App\Profile;
use Illuminate\Database\Seeder;

class ProfilesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $profiles = [
        	['email' => 'test@test.com', 'name' => 'John Test', 'website' => 'www.johntest.com', 'country' => 'United States'],
        ];

        Profile::insert($profiles);
    }
}