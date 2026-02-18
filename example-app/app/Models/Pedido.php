<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $table = 'pedidos';

    protected $fillable = [
        'cliente_id',
        'vendedor_id',
        'fecha',
        'total',
        'estado'
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function vendedor()
    {
        return $this->belongsTo(Vendedor::class);
    }

    public function detalles() {
    return $this->hasMany(DetallePedido::class, 'pedido_id');
}
    public function factura()
    {
        return $this->hasOne(Factura::class);
    }
}
