<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgentDatasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agents', function (Blueprint $table) {
            $table->id();
            $table->string('agt_id', 22);             // agt => agent
            $table->string('agt_first_name', 55);     
            $table->string('agt_last_name', 55);
            $table->string('agt_other_name', 55);
            $table->string('agt_email', 100);
            $table->string('agt_phone_number', 22);
            $table->string('agt_chat_number', 22); 
            $table->string('agt_gender', 11);
            $table->string('agt_res_address', 100);
            $table->string('agt_res_city', 22);
            $table->string('agt_res_state', 22); 
            $table->string('agt_state_origin', 22);
            $table->string('agt_lga_origin', 22);
            $table->string('agt_home_town', 22);
            $table->date('agt_birth_date');
            $table->string('agt_birth_place', 22);
            $table->string('nok_fullname', 100);       // nok => next of kin
            $table->string('nok_res_address', 100);
            $table->string('nok_res_city', 22);
            $table->string('nok_res_state', 22);
            $table->string('nok_phone_number', 22);
            $table->string('nok_relationship', 22);
            $table->string('grt_first_name', 55);      // grt => guarantor
            $table->string('grt_last_name', 55);
            $table->string('grt_other_name', 55);  
            $table->string('grt_phone_number', 55);
            $table->integer('grt_age');
            $table->string('grt_res_address', 100);
            $table->string('grt_res_city', 22);
            $table->string('grt_res_state', 22);
            $table->string('grt_occupation', 22);
            $table->string('grt_bis_name', 55);
            $table->string('grt_bis_address', 100);
            $table->string('grt_relationship', 22);
            $table->string('grt_undertaken', 500);    // ut => undertaking
            $table->integer('actor_id');
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
        Schema::dropIfExists('agents');
    }
}
