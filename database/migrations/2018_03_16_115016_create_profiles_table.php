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

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('company_name');
            $table->string('country_code')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('country')->nullable();
            $table->string('payment_email')->nullable();
            $table->string('affliate_code')->nullable();
            $table->boolean('email_sent')->default(0);
            $table->boolean('is_affliate')->default(0);
            $table->boolean('is_influencer')->default(0);
            $table->boolean('mentioned_product')->default(0);
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
        Schema::dropIfExists('profiles');
    }
}
