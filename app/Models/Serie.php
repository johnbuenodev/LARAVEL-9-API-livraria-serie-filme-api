<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Serie extends Model
{
    use HasFactory;

    protected $fillable = ['nome'];

    //public $timeStamps = false; //deixa de popular no ato da criação registro no banco

        //scope filter exemplo
        // public function scopeAtivos($query, $ativos)
        // {
        //     //filtrando por capitulo
        //     //retornar somente registros que estiverem ativos exemplo
        //     //somente livros ativos
        //     //return $query->where('ativos', 1);

        // }

    public function livros() {
        return $this->hasMany(Livro::class); //1 serie para varios livros (relacionamento)
    }

}
