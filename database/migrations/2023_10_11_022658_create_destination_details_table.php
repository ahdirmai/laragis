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
        Schema::create('destination_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('destination_id');
            $table->enum('open_day_type', ['everyday', 'custom']);
            $table->enum('open_time_type', ['default', 'custom']);
            $table->json('detail')->nullable();

            $table->foreign('destination_id')->references('id')->on('destinations')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('destination_details');
    }
};
