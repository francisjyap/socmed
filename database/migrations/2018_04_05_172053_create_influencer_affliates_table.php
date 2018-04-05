<?php

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
            $table->string('type');
            $table->string('status')->nullable();
            $table->date('status_date')->nullable();
            $table->string('follow-up')->nullable();
            $table->date('follow-up_date')->nullable();
            $table->string('affliate_code')->nullable();
            $table->timestamps();
            $table->softDeletes();
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
