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
        'icon',
        'currency_unit',
    ];

    public function topupPackages()
    {
        return $this->hasMany(TopupPackage::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function getCurrencyUnitAttribute()
    {
        // If currency_unit is set in database, use it
        if ($this->attributes['currency_unit'] ?? null) {
            return $this->attributes['currency_unit'];
        }

        // Fallback mapping based on game name
        return match(strtolower($this->name)) {
            'valorant' => 'VP',
            'genshin impact' => 'Primogems',
            'roblox' => 'Robux',
            'zenless zone zero' => 'Denny',
            'mobile legends bang bang' => 'Diamonds',
            'pubg mobile' => 'UC',
            'honkai star rail' => 'Stellar Jade',
            'free fire' => 'Diamonds',
            'call of duty mobile' => 'CP',
            'magic chess go go' => 'Diamonds',
            default => 'Units'
        };
    }
} 