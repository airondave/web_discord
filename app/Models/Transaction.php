<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'buyer_name',
        'buyer_email',
        'game_id',
        'package_id',
        'payment_method_id',
        'player_id',
        'player_server',
        'price',
        'status',
        'payment_reference',
    ];

    protected $casts = [
        'price' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function game()
    {
        return $this->belongsTo(Game::class);
    }

    public function topupPackage()
    {
        return $this->belongsTo(TopupPackage::class, 'package_id');
    }

    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class);
    }
} 