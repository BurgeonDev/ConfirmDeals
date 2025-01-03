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
            $table->decimal('price_in_pkr', 10, 2);
            $table->integer('equivalence')->default(1);
            $table->integer('free_coins')->default(5);
            $table->integer('featured_ad_rate')->default(5);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('coins');
    }
}
