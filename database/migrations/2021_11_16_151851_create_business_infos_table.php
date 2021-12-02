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
            $table->integer('id')->primary();
            $table->string('name', 55)->nullable();
            $table->string('logo', 555)->nullable();
            $table->string('slogan', 111)->nullable();
            $table->string('phone_a', 22)->nullable();
            $table->string('phone_b', 22)->nullable();
            $table->string('email_a', 111)->nullable();
            $table->string('email_b', 111)->nullable();
            $table->string('address_a', 111)->nullable();
            $table->string('address_b', 111)->nullable();
            $table->text('about_us')->nullable();
            $table->string('facebook_link', 111)->nullable();
            $table->string('twitter_link', 111)->nullable();
            $table->string('instagram_link', 111)->nullable();
            $table->text('terms_of_service')->nullable();
            $table->text('privacy_policy')->nullable();
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
