<?php
/*
|   Authored/Written/Maintained by:
|       Francis Alec J. Yap
|       francisj.yap@gmail.com
|       https://github.com/francisjyap/socmed
|
*/

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
        $entries = [
            ['name' => 'Youtube'],
            ['name' => 'Facebook'],
            ['name' => 'Twitter'],
            ['name' => 'Instagram'],
            ['name' => 'Google+'],
            ['name' => 'Patreon'],
            ['name' => 'Pinterest'],
            ['name' => 'ask.fm'],
        ];

        SocialMediaTypes::insert($entries);
    }
}
