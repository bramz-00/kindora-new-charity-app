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
        Schema::create('good_proposals', function (Blueprint $table) {
            $table->id();
            $table->uuid('req_uuid')->unique();

            $table->unsignedBigInteger('good_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('exchange_good_id')->nullable();

            $table->foreign('good_id')->on("goods")->references("id")->onDelete("cascade");
            $table->foreign('user_id')->on("users")->references("id")->onDelete("cascade");
            $table->foreign('exchange_good_id')->on("goods")->references("id")->onDelete("cascade");

            $table->string('reject_reason')->nullable();
            $table->string('status')->default('new');
            $table->softDeletes();
            
            $table->timestamp('validated_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('good_requests');
    }
};
