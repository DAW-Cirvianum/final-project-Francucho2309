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
        Schema::create('shirt_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('shirt_id');
            $table->string('size', 5);
            $table->decimal('price', 8, 2);

            // Relation
            $table->foreign('shirt_id')->references('id')->on('shirts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('shirt_details', function (Blueprint $table) {
            $table->dropIfExists('shirt_details');
        });
    }
};
