<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    use HasFactory;

    // 1. IMPORTANTE: Desactivar los timestamps automáticos
    public $timestamps = false; 

    // 2. Definir los campos que se pueden llenar
    protected $fillable = [
        'pedido_id',
        'nro_factura',
        'tipo_factura',
        'metodo_pago',
        'iva',
        'total_facturado',
        'fecha_emision'
    ];

    // 3. Relación con el pedido (para sacar el nombre del cliente luego)
    public function pedido()
    {
        return $this->belongsTo(Pedido::class, 'pedido_id');
    }
}