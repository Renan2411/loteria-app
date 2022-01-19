<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Numeros extends Model
{
    use HasFactory;

    protected $casts = [
        'numeros' => 'array'
    ];

    protected $fillable = [
        'numeros', 'concurso_id'
    ];

    public function concurso(){
        return $this->belongsTo(Concurso::class);
    }

}
