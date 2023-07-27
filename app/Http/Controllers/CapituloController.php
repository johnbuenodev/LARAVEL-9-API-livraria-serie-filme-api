<?php

namespace App\Http\Controllers;

use App\Models\Capitulo;
use Illuminate\Http\Request;

class CapituloController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Capitulo::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return Capitulo::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //return Capitulo::findOrfail($id);
        $capitulo = Capitulo::find($id);

        if($capitulo) {
            $capitulo->livro;
            $response = [
                'capitulo' => $capitulo,
                //'livro' => $capitulo->livro
            ];

            return response()->json([
             $response
            ],200);

        }

        return response()->json([
            'message' => 'Erro ao pesquisar registro'
        ], 200);

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
        $getCapitulo = Capitulo::findOrfail($id);
        $getCapitulo->update($request->all());
        return $getCapitulo;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Capitulo::destroy($id);
    }
}
