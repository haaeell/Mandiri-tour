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
        Schema::create('paket_wisata_wisata', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('paket_wisata_id');
            $table->unsignedBigInteger('wisata_id');
            $table->timestamps();

            // Definisi kunci asing
            $table->foreign('paket_wisata_id')->references('id')->on('paket_wisata')->onDelete('cascade');
            $table->foreign('wisata_id')->references('id')->on('wisata')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paket_wisata_wisata');
    }
};