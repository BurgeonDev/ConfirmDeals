<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeedbackTable extends Migration
{
    public function up()
    {
        Schema::create('feedbacks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ad_id');
            $table->string('name');
            $table->string('email');
            $table->text('comments');
            $table->timestamps();

            $table->foreign('ad_id')->references('id')->on('ads')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('feedback');
    }
}
