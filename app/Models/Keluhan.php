<?php

namespace App\Models;

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
}
