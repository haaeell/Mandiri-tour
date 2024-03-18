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
        Schema::create('rundowns', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('paket_wisata_id');
            $table->foreign('paket_wisata_id')->references('id')->on('paket_wisata')->onDelete('cascade');
            $table->integer('hari_ke');
            $table->time('mulai');
            $table->time('selesai');
            $table->string('deskripsi');
            $table->timestamps();
                });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rundowns');
    }
};
