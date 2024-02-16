<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class PaketWisata extends Model
{
    use HasFactory, Searchable;
    
    protected $table = 'paket_wisata';
    protected $fillable = ['nama', 'gambar', 'deskripsi', 'fasilitas', 'harga',  'kategori', 'durasi','slug'];

    public function kotas()
    {
        return $this->belongsToMany(Kota::class, 'paket_wisata_kota', 'paket_wisata_id', 'kota_id');
    }

    public function wisatas()
    {
        return $this->belongsToMany(Wisata::class, 'paket_wisata_wisata', 'paket_wisata_id', 'wisata_id');
    } 

    public function toSearchableArray(): array
{
    return [
        'nama' => $this->nama,
        'harga' => $this->harga,
    ];
}
}
