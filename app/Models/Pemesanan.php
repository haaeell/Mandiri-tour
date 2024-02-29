<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pemesanan extends Model
{
    use HasFactory;
    protected $table = 'pemesanan';
    protected $fillable = [
        'id',
        'user_id',
        'paket_id',
        'jumlah_paket',
        'tanggal_keberangkatan',
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
    public function getTanggalKeberangkatanIndoAttribute()
{
    // Mengonversi kolom tanggal_keberangkatan ke dalam format bahasa Indonesia
    return Carbon::parse($this->tanggal_keberangkatan)->translatedFormat('l, d F Y');
}
public function getCreatedAtIndoAttribute()
    {
        return Carbon::parse($this->created_at)->translatedFormat('l, d F Y ');
    }
    
}
