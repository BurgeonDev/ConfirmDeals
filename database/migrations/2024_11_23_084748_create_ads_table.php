<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdsTable extends Migration
{
    public function up()
    {
        Schema::create('ads', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->enum('type', ['service', 'product']);
            // $table->boolean('is_verified')->default(false);
            $table->enum('status', ['verified', 'cancel', 'expired', 'pending'])->default('pending');
            $table->json('pictures')->nullable(); // Stores image paths as JSON
            $table->decimal('price', 10, 2)->nullable();
            $table->unsignedBigInteger('country_id');
            $table->unsignedBigInteger('city_id');
            $table->unsignedBigInteger('locality_id')->nullable();
            $table->unsignedInteger('coins_needed')->default(0);
            $table->unsignedBigInteger('user_id');
            $table->boolean('is_featured')->default(false);
            $table->integer('days_featured')->nullable();
            $table->timestamp('featured_until')->nullable();

            $table->unsignedBigInteger('category_id');
            $table->timestamps();

            // Foreign keys
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');
            $table->foreign('locality_id')->references('id')->on('localities')->onDelete('set null');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }


    public function down()
    {
        Schema::dropIfExists('ads');
    }
}
