<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {   if(Schema::hasTable('request_comments')) return;
        Schema::create('request_comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('request_id');
            $table->text('admin_comment')->nullable();
            $table->date('adm_comment_date')->nullable();
            $table->text('client_comment')->nullable();
            $table->date('clt_comment_date')->nullable();
            $table->text('agent_comment')->nullable();
            $table->date('agt_comment_date')->nullable();
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
        Schema::dropIfExists('request_comments');
    }
}
