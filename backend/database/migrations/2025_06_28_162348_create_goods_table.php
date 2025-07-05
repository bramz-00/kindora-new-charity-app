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
        Schema::create('goods', function (Blueprint $table) {
            $table->id();
            $table->string('title')->unique();
            $table->uuid('good_uuid')->unique();
            $table->text('description');
            $table->string('slug')->unique();
            $table->string('state')->default('used');
            $table->string('type')->default('donation');
            $table->string('status')->default("available");
            $table->text('exchange_condition')->nullable();
            $table->unsignedBigInteger('owner_id');
            $table->foreign('owner_id')->on("users")->references("id")->onDelete("cascade");
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->on("categories")->references("id")->onDelete("cascade");
            $table->boolean('is_active')->default(true);
            $table->softDeletes(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('goods');
    }
};
