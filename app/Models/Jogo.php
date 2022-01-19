<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jogo extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'number_quantity', 'minimo', 'maximo'
    ];

    public function prices(){
        return $this->hasMany(Price::class, 'jogo_id');
    }

    public function concursos(){
        return $this->hasMany(Concurso::class, 'jogo_id');
    }
}
