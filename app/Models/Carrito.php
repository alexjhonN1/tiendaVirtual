<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Carrito extends Model
{
    // Tabla asociada
    protected $table = 'carritos';

    // Atributos que se pueden asignar masivamente
    protected $fillable = ['user_id', 'producto_id', 'cantidad', 'estado'];

    // Relación con el modelo Producto
    public function producto()
    {
        return $this->belongsTo(Producto::class, 'producto_id');
    }

    // Relación con el modelo User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Accesor para calcular el subtotal de un producto en el carrito
    public function getSubtotalAttribute()
    {
        return $this->producto ? $this->producto->precio * $this->cantidad : 0;
    }

    // Mutador para asegurar que la cantidad no sea menor a 1
    public function setCantidadAttribute($value)
    {
        $this->attributes['cantidad'] = max((int)$value, 1);
    }

    // Scope para filtrar por usuario actual
    public function scopePorUsuario($query, $userId)
    {
        return $query->where('user_id', $userId);
    }
}
