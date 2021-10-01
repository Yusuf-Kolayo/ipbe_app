<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
<<<<<<< HEAD
        
=======
>>>>>>> 736244a36da598292ce52e1ab5e0fb0901232336
        if(Schema::hasTable('expenses')) return;
        Schema::create('expenses', function (Blueprint $table) {
            $table->bigIncrements('expense_id');
            $table->datetime('date');
            $table->string('initiator');
            $table->unsignedBigInteger('cat_id');
            $table->enum('branch', ['Adekoya,Square-Anthony', 'Maryland']);
            $table->float('amount');
            $table->string('evidence');
            $table->text('description');
            $table->timestamps();

            $table->foreign('cat_id')->references('id')->on('expenses_categories')->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('expenses');
    }
}
