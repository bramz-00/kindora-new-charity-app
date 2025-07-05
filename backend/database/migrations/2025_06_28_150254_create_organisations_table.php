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
        Schema::create('organisations', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->date('registration_date')->nullable();
            $table->string('registration_number')->unique(); 
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->string('website')->nullable();
            $table->string('logo')->nullable();
            $table->text('address');
            $table->text('description');
            $table->text('country')->default('Algeria');
            $table->string('legal_status')->default('association');
            $table->boolean('verified')->default( false);
            $table->boolean('is_active')->default( true);
            $table->unsignedBigInteger('president_id');
            $table->foreign('president_id')->on("users")->references("id")->onDelete("cascade");
            $table->softDeletes(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('organisations');
    }
};
