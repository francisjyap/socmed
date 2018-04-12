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
        /*
        *   class 0 - Influencer, class 1 - Affliate
        */
        $entries = [
            ['profile_id' => '1', 'class' => 0],
            ['profile_id' => '1', 'class' => 1],
        ];

        InfluencerAffliate::insert($entries);
    }
}
