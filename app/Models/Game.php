<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'game_code',
        'publisher',
    ];

    public function topupPackages()
    {
        return $this->hasMany(TopupPackage::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
} 