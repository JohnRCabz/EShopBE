<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = ['item_id', 'quantity'];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public static function totalQuantity()
    {
        return self::sum('quantity');
    }

    public static function totalAmount()
    {
        return self::with('item')->get()->sum(function ($cart) {
            return $cart->item->price * $cart->quantity;
        });
    }
}