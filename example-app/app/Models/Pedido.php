<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pedido extends Model
{
    protected $table = 'pedido';
    protected $fillable = ['user_id', 'cliente_id', 'producto_id', 'vendedor_id', 'fecha', 'cantidad', 'total'];
    public $timestamps = false;

    public function cliente(): BelongsTo
    {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }

    public function producto(): BelongsTo
    {
        return $this->belongsTo(Producto::class, 'producto_id');
    }

    public function vendedor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'vendedor_id');
    }
}
