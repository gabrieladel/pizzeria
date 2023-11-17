<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function addToCart($userId, $quantity = 1)
    {
        $cartItem = CartItem::firstOrNew([
            'user_id' => $userId,
            'product_id' => $this->id
        ]);

        $cartItem->quantity += $quantity;
        $cartItem->save();
    }
}