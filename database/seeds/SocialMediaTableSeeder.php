<?php

use App\SocialMedia;
use Illuminate\Database\Seeder;

class SocialMediaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $entries = [
        	['profile_id' => '1', 'type' => '1', 'username' => 'johntest', 'url' => 'http://youtube.com/johntest', 'followers' => '10000'],
        ];

        SocialMedia::insert($entries);
    }
}
