<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTargetSavingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(Schema::hasTable('target_savings')) return;
        Schema::create('target_savings', function (Blueprint $table) {
            $table->id();
            $table->string('client_id', 55);
            $table->string('client_no');
            $table->string('client_email');
            $table->string('overall_value');
            $table->enum('target_plan', ['monthly', '3-months', '6-months', 'not-specific']);
            $table->enum('target_routine', ['daily', 'weekly']);
            $table->string('routine_amount');
            $table->text('target_reason');
            $table->string('bank_name');
            $table->string('acc_no');
            $table->string('acc_name');
            $table->timestamps();

            //$table->foreign('client_id')->references('client_id')->on('clients')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('target_savings');
    }
}
