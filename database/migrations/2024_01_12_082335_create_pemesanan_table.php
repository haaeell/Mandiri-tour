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
        Schema::create('pemesanan', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('paket_id');
            $table->integer('jumlah_paket');
            $table->date('tanggal_keberangkatan');
            $table->string('alamat');
            $table->text('bukti_pembayaran')->nullable();
            $table->enum('status_pembayaran', ['Belum Dibayar', 'Menunggu Konfirmasi Admin', 'Pembayaran Diterima', 'Pembayaran Ditolak','Pemesanan Dibatalkan'])->default('Belum Dibayar');
            $table->decimal('total_pembayaran', 10, 2)->default(0);
            $table->timestamps();
    
            // Foreign keys
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('paket_id')->references('id')->on('paket_wisata')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemesanan');
    }
};
