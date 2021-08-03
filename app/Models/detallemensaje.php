<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detallemensaje extends Model
{
    use HasFactory;

    protected $fillable = [
        'hora',
        'fecha',
        'mensaje',
        'usuario',
        'id_mensaje',
        
    ];

    protected $hidden = [
        'updated_at',
        'created_at',
        
    ];

}
