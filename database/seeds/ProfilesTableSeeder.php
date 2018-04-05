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
        $entries = [
        	['id' => '1', 'email' => 'test@test.com', 'name' => 'John Test', 'website' => 'http://www.johntest.com', 'country' => 'United States'],
        ];

        Profile::insert($entries);
    }
}
