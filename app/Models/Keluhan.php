<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keluhan extends Model
{
    use HasFactory;
    protected $fillable = ['subject', 'description', 'user_id', 'status', 'admin_response'];
    protected $table = 'keluhan';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getCreatedAtIndoAttribute()
    {
        return Carbon::parse($this->created_at)->translatedFormat('l, d F Y ');
    }
}
