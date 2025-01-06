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
            $table->timestamps();           // To store created_at and updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('app_config');
    }
}
