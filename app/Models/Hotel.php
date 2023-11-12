<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;
    protected $table = 'hotel';
    protected $fillable = [
        'nama',
        'deskripsi',
        'kota_id',
        'fasilitas',
        'gambar'
    ];


    public function kota()
    {
        return $this->belongsTo(Kota::class);
    }
}
