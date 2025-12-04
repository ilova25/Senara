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
        Schema::create('payment', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('booking_id');
            $table->foreign('booking_id')->references('id')->on('booking')->onDelete('cascade');
            $table->string('order_id')->nullable();
            $table->string('transaction_id')->nullable();
            $table->string('metode_pembayaran')->nullable();
            $table->string('status_pembayaran')->default('pending'); 
            $table->integer('gross_amount')->default(0);
            $table->string('snap_token')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment');
    }
};
