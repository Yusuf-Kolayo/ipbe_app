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
            $table->string('slider_id', 55);
            $table->string('status', 22);
            $table->string('background', 1000);
            $table->integer('position');
            $table->string('type', 22);
            $table->string('link_text', 22);
            $table->string('link_url', 5000);
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
