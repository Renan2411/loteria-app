<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    use HasFactory;

    protected $fillable = [
        'jogo_id', 'quantidade', 'valor', 'maximo'
    ];

    public function jogo(){
        return $this->belongsTo(Jogo::class);
    }
}
