<?php

namespace App\Models;
use App\Models\Persona;


use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    protected $table = 'personas';

    protected $fillable = [
        'user_id',
        'nombre',
        'apellido',
        'telefono'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function cliente()
    {
        return $this->hasOne(Cliente::class);
    }

    public function vendedor()
    {
        return $this->hasOne(Vendedor::class);
    }
}

