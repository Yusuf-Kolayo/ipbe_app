<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccessPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(Schema::hasTable('access_permissions')) return;
        Schema::create('access_permissions', function (Blueprint $table) {
            $table->id();
            $table->string('user_id', 22)->unique('user_id');
            $table->string('title', 22);
            $table->string('section', 22); 
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
        Schema::dropIfExists('staffs');
    }
}
