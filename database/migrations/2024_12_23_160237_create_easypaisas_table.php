<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEasypaisasTable extends Migration
{
    public function up()
    {
        Schema::create('easypaisas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('package_name');
            $table->decimal('payment', 10, 2);
            $table->string('transaction_reference')->nullable();
            $table->enum('status', ['pending', 'success', 'failed'])->default('pending');
            $table->string('phone'); // Added phone column
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('easypaisas');
    }
}