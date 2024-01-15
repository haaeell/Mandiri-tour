<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailMarketing extends Model
{
    use HasFactory;
    protected$table = "email_marketing";
    protected $fillable = [
        'subject',
        'content',
        'status',
    ];
}
