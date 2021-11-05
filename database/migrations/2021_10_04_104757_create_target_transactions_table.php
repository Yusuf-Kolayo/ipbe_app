<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTargetTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(Schema::hasTable('target_transactions')) return;
        Schema::create('target_transactions', function (Blueprint $table) {
            $table->bigIncrements('transaction_id');
            $table->foreignId('target_saving_id');
            $table->float('amount_paid');
            $table->float('new_balance');
            $table->enum('method',['cash','transfer','deposit']);
            $table->string('creditor_name');
            $table->date('payment_date');
            $table->string('evidence_transfer_deposit')->nullable();
            $table->timestamps();

            $table->foreign('target_saving_id')->references('id')->on('target_savings')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('target_transactions');
    }
}
