<?php

use App\SocialMediaTypes;
use Illuminate\Database\Seeder;

class SocialMediaTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            ['name' => 'Youtube'],
            ['name' => 'Facebook'],
            ['name' => 'Twitter'],
            ['name' => 'Instagram'],
            ['name' => 'Google+'],
            ['name' => 'Patreon'],
            ['name' => 'Pinterest'],
            ['name' => 'ask.fm'],
        ];

        SocialMediaTypes::insert($types);
    }
}
