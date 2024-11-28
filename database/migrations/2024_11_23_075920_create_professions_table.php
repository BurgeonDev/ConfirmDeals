<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfessionsTable extends Migration
{
    public function up()
    {
        Schema::create('professions', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique(); // Profession name (e.g., Engineer, Doctor)
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('professions');
    }
}
