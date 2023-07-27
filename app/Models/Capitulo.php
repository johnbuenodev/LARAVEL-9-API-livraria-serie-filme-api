<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Capitulo extends Model
{
    use HasFactory;
    protected $fillable = ['capitulo', 'texto', 'livro_id'];

    //scope filter exemplo
    public function scopeCapitulo($query, $capitulo)
    {
        return $query->where('capitulo', $capitulo);
    }

    public function livro()
    {
        return $this->belongsTo(Livro::class); //1 Capitulo para 1 livro (relacionamento)
    }
}

//criar os endpoints chamadas no insomnia para Capitulo
