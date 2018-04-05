<?php

use App\InfluencerAffliate;
use Illuminate\Database\Seeder;

class InfluencerAffliatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $entries = [
            ['profile_id' => '1', 'type' => 'influencer'],
            ['profile_id' => '1', 'type' => 'affliate'],
        ];

        InfluencerAffliate::insert($entries);
    }
}
