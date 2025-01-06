<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppConfigTable extends Migration
{
    public function up()
    {
        Schema::create('app_config', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique(); // The key for each setting
            $table->string('value');         // The value for each setting
            $table->unsignedBigInteger('created_by')->nullable(); // Added created_by
            $table->unsignedBigInteger('updated_by')->nullable(); // Added updated_by
            $table->timestamps();           // To store created_at and updated_at

            // Adding foreign key constraints (assuming you have a users table)
            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('app_config', function (Blueprint $table) {
            $table->dropForeign(['created_by']);
            $table->dropForeign(['updated_by']);
        });

        Schema::dropIfExists('app_config');
    }
}
