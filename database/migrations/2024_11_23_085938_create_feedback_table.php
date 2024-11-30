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
            $table->unsignedBigInteger('user_id'); // Add user_id column
            $table->string('name');
            $table->string('email');
            $table->text('comments');
            $table->timestamps();

            // Set up foreign key constraints
            $table->foreign('ad_id')->references('id')->on('ads')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); // Foreign key for user_id
        });
    }

    public function down()
    {
        Schema::dropIfExists('feedbacks');
    }
}
