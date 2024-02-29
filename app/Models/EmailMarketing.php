<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EmailMarketing extends Model
{
    use HasFactory;
    protected$table = "email_marketing";
    protected $fillable = [
        'subject',
        'content',
        'status',
    ];

    public function getCreatedAtIndoAttribute()
    {
        return Carbon::parse($this->created_at)->translatedFormat('l, d F Y H:i:s');
    }
}
