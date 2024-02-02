<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{
    use HasFactory;
    protected $table = 'pemesanan';
    protected $fillable = [
        'id',
        'user_id',
        'paket_id',
        'jumlah_peserta',
        'tanggal_pemesanan',
        'total_pembayaran',
        'bukti_pembayaran',
        'status_pembayaran',
        'alamat',
    ];

    // Relasi dengan model User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi dengan model Paket
    public function paket()
    {
        return $this->belongsTo(PaketWisata::class);
    }
    public function getIncrementing()
    {
        return false;
    }
    function getKeyType()
    {
        return 'string';
    }
    
}
