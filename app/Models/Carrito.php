<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Carrito extends Model
{
    
    protected $table = 'carritos';

    protected $fillable = ['user_id', 'producto_id', 'cantidad', 'estado'];

    public function producto()
    
    {
        return $this->belongsTo(Producto::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
