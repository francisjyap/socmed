<?php
/*
|   Authored/Written/Maintained by:
|       Francis Alec J. Yap
|       francisj.yap@gmail.com
|       https://github.com/francisjyap/socmed
|
*/

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
