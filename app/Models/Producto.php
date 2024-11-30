<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'descripcion', 'precio', 'stock', 'imagen', 'categoria_id'];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }
    public function reseñas()
    {
        return $this->hasMany(Resena::class, 'producto_id');
    }
}
