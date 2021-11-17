<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(Schema::hasTable('business_infos')) return;
        Schema::create('business_infos', function (Blueprint $table) {
            $table->id();
            $table->integer('id')->primary();
            $table->string('name', 55)->nullable();
            $table->string('logo', 100)->nullable();
            $table->string('slogan', 55)->nullable();
            $table->string('phone_a', 55)->nullable();
            $table->string('phone_b', 55)->nullable();
            $table->string('support_email', 55)->nullable();
            $table->string('address_a', 55)->nullable();
            $table->string('address_b', 55)->nullable();
            $table->string('about_us', 55)->nullable();
            $table->string('facebook_link', 55)->nullable();
            $table->string('twitter_link', 55)->nullable();
            $table->string('instagram_link', 55)->nullable();
            $table->string('terms_of_service', 55)->nullable();
            $table->string('privacy_policy', 55)->nullable();
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
        Schema::dropIfExists('business_infos');
    }
}
