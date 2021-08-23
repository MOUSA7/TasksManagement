<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSecureCheckInTasksTable extends Migration
{

    public function up()
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->text('secure_check')->nullable();
            $table->integer('Send_to_sincere')->nullable();
            $table->string('created_certification')->nullable();
            $table->string('invoice')->nullable();
            $table->string('packing_list')->nullable();
        });
    }


    public function down()
    {
        Schema::table('tasks', function (Blueprint $table) {
            //
        });
    }
}
