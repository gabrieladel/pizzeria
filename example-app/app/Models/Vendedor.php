<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vendedor extends Model
{
    protected $table = 'vendedores';

    protected $fillable = [
        'persona_id',
        'legajo'
    ];

    public function persona()
    {
        return $this->belongsTo(Persona::class);
    }

    public function pedidos()
    {
        return $this->hasMany(Pedido::class);
    }
}

?>