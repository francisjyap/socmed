<?php
/*
|   Authored/Written/Maintained by:
|       Francis Alec J. Yap
|       francisj.yap@gmail.com
|       https://github.com/francisjyap/socmed
|
*/

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
        	UsersTableSeeder::class,
            ProfilesTableSeeder::class,
            EmailsTableSeeder::class,
            WebsitesTableSeeder::class,
            SocialMediaTableSeeder::class,
            SocialMediaTypesTableSeeder::class,
            InfluencerAffliatesTableSeeder::class,
            
        ]);
    }
}
