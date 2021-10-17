<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStaffsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staffs', function (Blueprint $table) {
            $table->id();
            $table->string('staff_id', 22)->unique('agent_id');
            $table->string('first_name', 55);
            $table->string('last_name', 55);
            $table->string('other_name', 55);
            $table->string('phone', 22);
            $table->string('gender', 11);
            $table->string('address', 100);
            $table->string('city', 22)->nullable();
            $table->string('state', 22)->nullable();
            $table->date('birth_date')->nullable();
            $table->string('actor_id', 22);
            $table->timestamps()->default('current_timestamp()');
        });
    }


    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('staffs');
    }
}
