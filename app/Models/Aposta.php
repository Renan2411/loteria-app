<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Jogo;

class Aposta extends Model
{
    use HasFactory;

    protected $casts = [
        'numeros' => 'array'
    ];

    protected $fillable = [
        'price_id', 'concurso_id', 'numeros', 'premiado', 'codigo', 'pontos'
    ];

    public function price(){
        return $this->belongsTo(Price::class);
    }

    public function concurso(){
        return $this->belongsTo(Concurso::class);
    }
}
