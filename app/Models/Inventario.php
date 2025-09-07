<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventario extends Model
{
    use HasFactory;
    protected $table = 'inventarios';
    protected $fillable = [
        'producto_id',
        'cantidad',
        'precio_venta',
        'fecha_movimiento',
        'motivo',
        'tipo_movimiento'
    ];

    protected $casts = [
        'fecha_movimiento' => 'date',
        'precio_venta' => 'decimal:2',
        'cantidad' => 'integer'
    ];

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }

    // Scopes para filtrar por tipo de movimiento
    public function scopeEntradas($query)
    {
        return $query->where('tipo_movimiento', 'entrada');
    }

    public function scopeSalidas($query)
    {
        return $query->where('tipo_movimiento', 'salida');
    }

    public function scopeAjustes($query)
    {
        return $query->where('tipo_movimiento', 'ajuste');
    }

    // Scope para filtrar por producto
    public function scopeByProducto($query, $productoId)
    {
        return $query->where('producto_id', $productoId);
    }
}
