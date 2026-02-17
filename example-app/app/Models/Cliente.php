<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Persona;
use App\Models\Pedido;

class Cliente extends Model
{
    protected $table = 'clientes';

    protected $fillable = [
        'persona_id',
        'cuil'
    ];

     public $timestamps = false;

    public function persona()
    {
        return $this->belongsTo(Persona::class);
    }

    public function pedidos()
    {
        return $this->hasMany(Pedido::class);
    }
}
