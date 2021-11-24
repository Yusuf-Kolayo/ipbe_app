<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoreSlidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {   if(Schema::hasTable('store_sliders')) return;
        Schema::create('store_sliders', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->string('slider_id', 22);
            $table->string('status', 11);
            $table->string('background', 100);
            $table->integer('position');
            $table->string('type');
            $table->string('link_text');
            $table->string('link_url'); 
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
        Schema::dropIfExists('store_sliders');
    }
}
