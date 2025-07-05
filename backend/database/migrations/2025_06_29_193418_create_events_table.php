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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('organisation_id');
            $table->unsignedBigInteger( 'created_by_id');

            $table->foreign('organisation_id')->on("organisations")->references("id")->onDelete("cascade");
            $table->foreign('created_by_id')->on("users")->references("id")->onDelete("cascade");
            
            $table->string('title');
            $table->text('description');
            $table->string('location');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->decimal('target_amount',10,2)->nullable();
            $table->string('status')->default('open');//public, private
            $table->string('type')->default('public');
            $table->boolean('is_active')->default( true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
