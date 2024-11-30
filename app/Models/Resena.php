<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resena extends Model
{
    protected $fillable = ['producto_id', 'user_id', 'comentario', 'calificacion', 'aprobado'];

    public function producto()
        {
            return $this->belongsTo(Producto::class);
        }

        public function user()
        {
            return $this->belongsTo(User::class);
        }

    public $timestamps = true;
}
