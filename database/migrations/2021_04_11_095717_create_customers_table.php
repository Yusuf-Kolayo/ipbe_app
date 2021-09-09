<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('first_name', 100);
            $table->string('last_name', 55);
            $table->string('other_name', 55);
            $table->string('phone', 55);
            $table->string('email', 100);
            $table->string('str_address', 1000);
            $table->string('community_area', 100);
            $table->string('city', 55);
            $table->string('state', 55);
            $table->string('username', 55);
            $table->string('password', 1000);
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
        Schema::dropIfExists('customers');
    }
}
