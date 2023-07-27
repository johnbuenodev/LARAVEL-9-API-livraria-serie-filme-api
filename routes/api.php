<?php

use App\Http\Controllers\SerieController;
use App\Http\Controllers\LivroController;
use App\Http\Controllers\CapituloController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::get('/teste', function() {
//     return "teste com sucesso";
// });

//add beartoken o token gerado quando solicitar endpoint
Route::group(['middleware' => ['auth:sanctum']], function() {

    //1 opcao
    Route::get('/serie', [SerieController::class, 'index']); //get all
    Route::get('/serie/{id}', [SerieController::class, 'show']); //get by id
    Route::put('/serie/{id}', [SerieController::class, 'update']); //put / update
    Route::post('/serie', [SerieController::class, 'store']); //passa o controller e o nome do metodo que vai acessar atraves daquela rota
    Route::delete('/serie/{id}', [SerieController::class, 'destroy']);

    Route::get('/livro', [LivroController::class, 'index']);
    Route::get('/livro/{id}', [LivroController::class, 'show']);
    Route::put('/livro/{id}', [LivroController::class, 'update']);
    Route::put('/livro-image/{id}', [LivroController::class, 'updateImage']);
    Route::post('/livro', [LivroController::class, 'store']);
    Route::delete('/livro/{id}', [LivroController::class, 'destroy']);

    Route::get('/capitulo', [CapituloController::class, 'index']);
    Route::get('/capitulo/{id}', [CapituloController::class, 'show']);
    Route::put('/capitulo/{id}', [CapituloController::class, 'update']);
    Route::post('/capitulo', [CapituloController::class, 'store']);
    Route::delete('/capitulo/{id}', [CapituloController::class, 'destroy']);

//Compactar as rotas atraves do apiResouce só que ele vai esperar receber um objeto
//Caso utilize deixe comentado as rotas acima
//e descomente o apiResource de cada rota de modelo capitulo, livro ...

//2 opcao
//Route::apiResource('capitulo', CapituloController::class);

//3 opcao
// Route::apiResources([
//  'serie' => SerieController::class,
//  'livro' => LivroController::class,
//  'capitulo' => CapituloController::class,
// ]);

    Route::post('/logout', [AuthController::class, 'logout']);

});

// PARA ACESSAR IMAGEM SALVA NO STORAGE
//http://127.0.0.1:8000/storage/capa_livro//znhO7p3y3mdas14yly0lSc3kNC4nZv4z7QYediGp.jpg

//MENOS O REGISTER E O LOGIN QUE PRECISAM FICAR ABERTOS PARA ACESSO
Route::post('/register', [AuthController::class, 'register']);
//campos utilizado no endpoint name email password password_confirmation  nameToken
//Header -    Accept   -   application/json
Route::post('/login', [AuthController::class, 'login']);


//get by nome
Route::get('/get-by-nome/{value}', [SerieController::class, 'getByNome']);

Route::get('/get-register-random', [SerieController::class, 'getRegisterRandom']);
