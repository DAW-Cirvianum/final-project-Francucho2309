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
        Schema::create('shirts_categories', function (Blueprint $table) {
            $table->unsignedBigInteger('shirt_id');
            $table->unsignedBigInteger('category_id');

            // Relation
            $table->foreign('shirt_id')->references('id')->on('shirts')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');

            // Primary key
            $table->primary(['shirt_id', 'category_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('shirts_categories', function (Blueprint $table) {
            $table->dropIfExists('shirts_categories');
        });
    }
};
