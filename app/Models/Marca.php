<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    use HasFactory;
    protected $table = 'marcas';

    protected $fillable = [
        'descripcion',
        'estado'
    ];

    public function modelos()
    {
        return $this->hasMany(Modelo::class);
    }

    public function productos()
    {
        return $this->hasManyThrough(
            Producto::class, 
            Modelo::class,   
            'marca_id',       
            'modelo_id',      
            'id',             
            'id'              
        );
    }
}
