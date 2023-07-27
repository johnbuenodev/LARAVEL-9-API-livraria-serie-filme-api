<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Livro extends Model
{
    use HasFactory;
    protected $fillable = ['nome','abreviacao','posicao','serie_id'];

    public function serie() {
        return $this->belongsTo(Serie::class); //1 livro para 1 serie (relacionamento)
    }

    public function capitulos() {
        return $this->hasMany(Capitulo::class); //1 livro para varios capitulos (relacionamento)
    }

}

//criar os endpoints chamadas no insomnia para livros
