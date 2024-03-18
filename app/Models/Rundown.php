<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rundown extends Model
{
    use HasFactory;

    protected $fillable = ['paket_wisata_id','hari_ke', 'mulai', 'selesai', 'deskripsi'];

    protected $table = 'rundowns';
    public function paketWisata()
    {
        return $this->belongsTo(PaketWisata::class);
    }
}
