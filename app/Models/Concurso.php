<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Concurso extends Model
{
    use HasFactory; 

    protected $casts = [
        'sorteado' => 'boolean'
    ];

    protected $fillable = [
        'jogo_id', 'codigo', 'sorteado'
    ];

    public function jogo(){
        return $this->belongsTo(Jogo::class);
    }

    public function apostas(){
        return $this->hasMany(Aposta::class, 'concurso_id');
    }

    public function numero(){
        return $this->hasOne(Numeros::class, 'concurso_id');
    }
}
