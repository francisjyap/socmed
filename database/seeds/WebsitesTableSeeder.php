<?php

use App\Website;
use Illuminate\Database\Seeder;

class WebsitesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $entries = [
            ['profile_id' => '1', 'website' => 'http://www.johntest123.com'],
        ];

        Website::insert($entries);
    }
}
