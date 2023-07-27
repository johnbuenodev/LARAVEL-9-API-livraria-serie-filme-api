<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request) {

        $fields = $request->validate([
         'name' => 'required|string',
         'email' => 'required|string|unique:users,email',
         'password' => 'required|string|confirmed',
        ]);

        $user = User::create([
          'name' => $fields['name'],
          'email' => $fields['email'],
          'password' => bcrypt($fields['password'])
        ]);

        $token = $user->createToken('UsuarioLogado')->plainTextToken; //'UsuarioLogado'  $request->nameToken

        //criando retorno Json estrutura
        $response = [
            'user' => $user,
            'token' => $token,
        ];

        //após criar retorna o usuario criado
        return response($response, 201); //retornando response e status criado
    }

    public function login(Request $request) {

        $fields = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $fields['email'])->first();

        if(!$user || !Hash::check($fields['password'], $user->password)) {
          return response([
            'message' => 'E-mail ou Senha invalidos.',
          ], 401);
        }

        //gerando o token
        $token = $user->createToken('UsuarioLogado')->plainTextToken;

        $response = [
          'user' => $user,
          'token' => $token,
        ];

        return response($response, 200);

    }

    public function logout() {

      auth()->user()->tokens()->delete();//fazer o logout pelo user autenticado

      $response = [
        'message' => 'Logout success'
      ];

      return response($response, 200);

    }

}
