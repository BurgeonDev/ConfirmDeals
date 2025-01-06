<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBidsTable extends Migration
{
    public function up()
    {
        Schema::create('bids', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // User making the bid/proposal
            $table->foreignId('ad_id')->constrained()->onDelete('cascade');   // Ad the bid/proposal is placed on
            $table->decimal('offer', 10, 2); // Proposed price or rate
            $table->enum('status', ['pending', 'accepted', 'rejected', 'confirmed', 'cancelled'])->default('pending'); // Proposal status
            $table->boolean('user_paid')->default(false); // Whether the bidder has paid the confirmation fee
            $table->boolean('seller_paid')->default(false); // Whether the ad owner has paid the confirmation fee
            $table->text('notes')->nullable(); // Additional details for service proposals
            $table->json('time_slots')->nullable(); // Proposed time slots for service proposals
            $table->timestamps(); // Created and updated timestamps

        });
    }

    public function down()
    {
        Schema::dropIfExists('bids');
    }
}
