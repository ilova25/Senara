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
        Schema::create('booking', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_user');
            $table->string('nama');
            $table->string('email');
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->date('checkin');
            $table->date('checkout');
            $table->decimal('total_harga', 12, 2)->nullable();
            $table->unsignedBigInteger('id_unit');
            $table->foreign('id_unit')->references('id_unit')->on('unit')->onDelete('cascade');
            $table->integer('adult')->default(1);
            $table->integer('children')->default(0);
            $table->string('kode_booking')->unique();
            $table->enum('status_pembayaran', ['pending','confirmed','canceled'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking');
    }
};
