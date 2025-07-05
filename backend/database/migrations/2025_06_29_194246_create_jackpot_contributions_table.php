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
        Schema::create('jackpot_contributions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger( 'jackpot_id');
            $table->unsignedBigInteger( 'user_id');

            $table->foreign('jackpot_id')->on("jackpots")->references("id")->onDelete("cascade");
            $table->foreign('user_id')->on("users")->references("id")->onDelete("cascade");
            
            $table->decimal( 'amount',10,2);
            $table->softDeletes(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jackpot_contributions');
    }
};
