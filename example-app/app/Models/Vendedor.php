<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Persona;
use App\Models\Pedido;

class Vendedor extends Model
{
    protected $table = 'vendedores';

    protected $fillable = [
        'persona_id',
        'legajo'
    ];
     public $timestamps = false;

   
    public function persona() {
        return $this->belongsTo(Persona::class, 'persona_id');
    }
    public function pedidos()
    {
        return $this->hasMany(Pedido::class);
    }
}

?>