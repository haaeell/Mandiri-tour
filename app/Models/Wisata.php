<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wisata extends Model
{
    use HasFactory;
    protected $table = 'wisata';
    protected $fillable = ['nama', 'kota_id', 'deskripsi', 'gambar'];

    public function kota()
    {
        return $this->belongsTo(Kota::class);
    }
}
