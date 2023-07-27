<?php

namespace App\Http\Controllers;

use App\Models\Serie;
use App\Models\Livro;
use Illuminate\Http\Request;

class SerieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Serie::all(); //get all registros
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return Serie::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //return Serie::find($id); // get by id
        //return Serie::findOrfail($id); // get by id
        $serie = Serie::find($id);

        if($serie) {

            $response = [
              'serie' => $serie,
              'livros' => $serie->livros
            ];

            return response()->json([
                $response,
            ], 200);
        }

        return response()->json([
           'message' => 'Erro ao pesquisar registro.'
        ], 404);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //Insomnia PUT Form ex: nome  valor-atribuido
        $getSerie = Serie::findOrfail($id);
        $getSerie->update($request->all());
        return $getSerie;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Serie::destroy($id);
    }

    public function getByNome($value) {

        //passa o nome da table
        /* se não enviar o valor seta null */
        //relacionamento definido no metodo da classe Serie
        $serie = Serie::whereHas('livros', function ($query) use($value) {
           $query->when($value, function($query) use($value) {
            //compara com a abreviação com o valor $livro recebido
            $query->where('abreviacao', $value);
           });
           //pode se usar o scope aqui })->capitulo($capitulo) //declarado no model a inicial do metodo como scope (scopeCapitulo) o laravel vai entender
        })->get();

        if($serie) {

            $response = [
              'serie' => $serie,
            ];

            return response()->json([
                $response,
            ], 200);
        }

        return response()->json([
           'message' => 'Erro ao pesquisar registro.'
        ], 404);

    }

    public function getRegisterRandom() {

        $serie = Serie::with(['livros'])->find(rand(1, 5));

        if($serie) {

            // $response = [
            //   'serie' => $serie,
            // ];

            return response()->json([
                $serie,
            ], 200);
        }

        return response()->json([
           'message' => 'Erro ao pesquisar registro.'
        ], 404);

    }

}
