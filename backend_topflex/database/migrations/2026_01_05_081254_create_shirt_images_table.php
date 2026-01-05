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
        Schema::create('shirt_images', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('shirt_id');
            $table->string('image_path');
            $table->timestamps();

            $table->foreign('shirt_id')->references('id')->on('shirts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shirt_images');
    }
};
