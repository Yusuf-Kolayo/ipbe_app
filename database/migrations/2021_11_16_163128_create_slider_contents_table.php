<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSliderContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {   if(Schema::hasTable('slider_contents')) return;
        Schema::create('slider_contents', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->string('slider_id', 22);
            $table->string('type');
            $table->integer('position');
            $table->string('content');
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
        Schema::dropIfExists('slider_contents');
    }
}
