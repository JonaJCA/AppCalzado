<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;
    protected $table = 'productos';

    protected $fillable = [
        'modelo_id',
        'categoria_id',
        'talla_id',
        'color_id',
        'codigo_producto',
        'nombre',
        'taco',
        'precio_compra',
        'stock_actual',
        'estado'
    ];

    public function modelo()
    {
        return $this->belongsTo(Modelo::class);
    }

    public function marca()
    {
        return $this->hasOneThrough(
            Marca::class,  
            Modelo::class,  
            'id',          
            'id',          
            'modelo_id',    
            'marca_id'      
        );
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function talla()
    {
        return $this->belongsTo(Talla::class);
    }

    public function color()
    {
        return $this->belongsTo(Color::class);
    }
}
