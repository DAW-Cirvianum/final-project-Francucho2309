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
        Schema::create('shirts_images', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('shirt_id');
            $table->string('url_image');
            $table->timestamps();

            // Relation
            $table->foreign('shirt_id')->references('id')->on('shirts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shirts_images');
    }
};
