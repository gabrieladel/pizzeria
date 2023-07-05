<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Cliente extends Model{
    use HasFactory;
    protected $table='cliente';
    protected $primarykey='id';
    protected $fillable=['cuil'];
    protected $guarded=[];
    public $timestamps=false;
    
}