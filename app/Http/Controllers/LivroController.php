<?php

namespace App\Http\Controllers;

use App\Models\Livro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LivroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Livro::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd("Request value:");
        //dd($request); //dump die ele // console.log do laravel
        //return Livro::create($request-all());
        if (Livro::create($request->all())) {
            return response()->json(
                [
                    'message' => ' Registro Cadastrado com sucesso.',
                ],
                201
            );
        }

        return response()->json(
            [
                'message' => ' Erro ao Cadastrar o Registro.',
            ],
            400
        ); //404 not found 400 bad request 500 internal error
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //find mesmo passando um objeto show($livro) quando passado para find ele busca pela chave primary
        $livro = Livro::find($id); //findOrfail outra opção pra outro contexto

        if ($livro) {
            //Trazer a serie junto
            $livro->serie;
            // $response = [
            //     'livro' => $livro,
            //     'serie' => $livro->serie,
            // ];

            //return response()->json([$response], 200);
            return response()->json([$livro], 200);
        }

        return response()->json(
            [
                'message' => ' Registro não encontrado.',
            ],
            404
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateImage(Request $request, $id)
    {
        //criar update normal
        //trabalhando com imagem passando para atributo name VARCHAR
        //$table->string('capa')->nullable();  isso está na migration
        //como pegar informações da imagem
        //dd($request->capa); //Todo o registro
        //dd($request->capa->hashName());
        //dd($request->capa->getClientOriginalName()); //nome original do arquivo

        //salvar pegar caminho e salvar caminho na capa no registro
        //0
        $path = $request->capa->store('capa_livro', 'public'); //store para armazenar
        //dentro de CONFIG -> FILE SYSTEM - tem as configurações de armazenamento de imagens
        //$pathInitial = "\\/"."storage"."\\/";

        //Funcionando
        //1
        //$pathInitial = "storage/"; //OK melhor - quando for consumir dados de imagem add o pathbase do local aonde estiver o sistema
        //2
        //$pathFinal = $pathInitial.$path; //CONCATENAR SEM ESPAÇO  $pathInitial.' '.$path CONCATENAR COM ESPAÇO
        //habilitar o public com link para imagens - php artisan storage:link

        if ($path) {
            // $pathFinal = Storage::disk('public')->url($path);

            $getLivro = Livro::find($id); //findOrfail
            if ($getLivro) {
                //Column/atributo capa vai receber o path
                $getLivro->capa = "/".$path; //$path $pathFinal

                if ($getLivro->save()) {
                    return $getLivro;
                }

                return response()->json(
                    [
                        'message' => ' Registro não encontrado.',
                    ],
                    404
                );
            }

            return response()->json(
                [
                    'message' => ' Registro não encontrado.',
                ],
                404
            );
        }

        return response()->json(
            [
                'message' => ' Erro ao salvar Imagem.',
            ],
            404
        );
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
        $getLivro = Livro::find($id); //findOrfail
        if ($getLivro) {
            $getLivro->update($request->all());
            return $getLivro;
        }

        return response()->json(
            [
                'message' => ' Registro não encontrado.',
            ],
            404
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Livro::destroy($id)) {
            return response()->json(
                [
                    'message' => ' Registro Deletado com sucesso.',
                ],
                201
            );
        }

        return response()->json(
            [
                'message' => ' Registro não encontrado.',
            ],
            404
        );
    }
}

//Todo criar tratativa para os outros endpoints do controller capitulo e serie
