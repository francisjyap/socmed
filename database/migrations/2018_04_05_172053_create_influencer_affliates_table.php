<?php
/*
|   Authored/Written/Maintained by:
|       Francis Alec J. Yap
|       francisj.yap@gmail.com
|       https://github.com/francisjyap/socmed
|
*/

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInfluencerAffliatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('influencer_affliates', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('profile_id');
            $table->boolean('class');
            $table->integer('status')->default(0);
            $table->date('status_date')->nullable();
            $table->integer('follow-up')->default(0);
            $table->date('follow-up_date')->nullable();
            $table->integer('latest_inf_log_id')->nullable();
            $table->integer('latest_aff_log_id')->nullable();
            $table->boolean('email_sent')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('influencer_affliates');
    }
}
