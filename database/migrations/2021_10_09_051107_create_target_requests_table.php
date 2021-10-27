<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTargetRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(Schema::hasTable('target_requests')) return;
        Schema::create('target_requests', function (Blueprint $table) {
            $table->bigIncrements('request_id');
            $table->date('request_date');
            $table->foreignId('target_saving_id');
            $table->float('amount_saved');
            $table->enum('payment_method',['Cash','Transfer','Swap For Product']);
            $table->string('bank_name')->nullable();
            $table->string('acc_no')->nullable();
            $table->string('acc_name')->nullable();
            $table->enum('request_status',['Requested','Pending','Completed'])->default('Requested');
            $table->date('approval_date')->nullable();
            $table->date('complete_date')->nullable();
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
        Schema::dropIfExists('target_requests');
    }
}
