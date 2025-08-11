<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CriticsAdvice extends Model
{
    use HasFactory;

    protected $table = 'critics_advice';

    protected $fillable = [
        'sender_name',
        'sender_email',
        'discord_username',
        'messages',
        'response',
    ];

    protected $casts = [
        // send_date cast removed as column no longer exists
    ];

    public function scopeUnresponded($query)
    {
        return $query->whereNull('response');
    }

    public function scopeResponded($query)
    {
        return $query->whereNotNull('response');
    }
} 