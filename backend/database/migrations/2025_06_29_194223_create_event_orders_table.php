<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('event_orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger( 'event_ticket_id');
            $table->unsignedBigInteger( 'user_id');

            $table->foreign('event_ticket_id')->on("event_tickets")->references("id")->onDelete("cascade");
            $table->foreign('user_id')->on("users")->references("id")->onDelete("cascade");

            $table->decimal( 'total_price',8,2)->default(0);
            $table->integer( 'quantity')->default(0);
            $table->string('status')->default('pending');
            $table->string('payment_method')->default('online');
            $table->dateTime("purchased_at")->nullable();
            $table->softDeletes(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_orders');
    }
};
