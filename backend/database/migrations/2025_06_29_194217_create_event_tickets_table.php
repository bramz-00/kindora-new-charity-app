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
        Schema::create('event_tickets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger( 'event_id');
            $table->foreign('event_id')->on("events")->references("id")->onDelete("cascade");

            $table->string( 'name')->nullable();
            $table->decimal( 'price',8,2)->default(0);
            $table->integer( 'quantity')->default(0);
            $table->integer( 'sold_count')->default(0);
            $table->softDeletes(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_tickets');
    }
};
