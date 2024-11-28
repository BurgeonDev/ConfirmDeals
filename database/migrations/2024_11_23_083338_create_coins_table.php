<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoinsTable extends Migration
{
    public function up()
    {
        Schema::create('coins', function (Blueprint $table) {
            $table->id();
            $table->integer('count')->default(0); // Number of coins
            $table->decimal('from_price', 10, 2); // Minimum price for coin purchase
            $table->decimal('to_price', 10, 2); // Maximum price for coin purchase
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('coins');
    }
}
