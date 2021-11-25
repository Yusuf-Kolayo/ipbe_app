<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePayrollsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(Schema::hasTable('payrolls')) return;
        Schema::create('payrolls', function (Blueprint $table) {
            $table->id();
            $table->string('employee_id');
            $table->string('employee_type');
            $table->date('pay_day');
            $table->string('salary');
            $table->string('rent_A');
            $table->string('med_A');
            $table->string('overtime_A');
            $table->string('convey_A');
            $table->string('retire_A');
            $table->string('other_A');
            $table->string('tax_D');
            $table->string('ab_work_D');
            $table->string('pension_D');
            $table->string('advance_D');
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
        Schema::dropIfExists('payrolls');
    }
}
