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
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('shirt_id');
            $table->integer('quantity');
            $table->decimal('unity_price', 8, 2);

            // Relation
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
            $table->foreign('shirt_id')->references('id')->on('shirts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('order_details', function (Blueprint $table) {
            $table->dropIfExists('order_details');
        });
    }
};
