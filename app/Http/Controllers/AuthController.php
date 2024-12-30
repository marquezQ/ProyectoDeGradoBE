<?php

namespace App\Http\Controllers;

use App\Models\Trabajador;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|max:255',
            'lastname' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'phone_number' => 'required|max:255',
            'profile_picture' => 'image|mimes:jpg,jpeg,png|max:20480', // máx. 20MB
            'password' => 'required'
        ]);

        if($validator->fails()){
            $data = [
                'message' => 'Error en la validacion de datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $filePath = '';
        if($request->hasFile('profile_picture')){
            $file = $request->file('profile_picture');
            $filePath = $file->store('profile_pictures', 'public');
        }

        $user = User::create([
            'name' => $request->name,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'profile_picture' => $filePath,
            'password' => $request->password,

        ]);
        if(!$user){
            $data = [
                'message' => 'Error al crear estudiante',
                'status' => 500
            ];
            return response()->json($data, 500);
        }

        $token = $user->createToken($request->name);

        return [
            'user' => $user,
            'token' => $token->plainTextToken
        ];
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email|',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return [
                'errors' => [
                    'email' => ['The provided credentials are incorrect.']
                ]
            ];
        }

        $token = $user->createToken($user->name);

        return [
            'user' => $user,
            'token' => $token->plainTextToken
        ];
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return [
            'message' => 'You are logged out.' 
        ];
    }

    public function isTrabajador($id){
        $trabajador = Trabajador::where('user_id', $id)
                // ->with('user')
                ->first();
        if($trabajador){
            return $trabajador;
        }
        return [
            'message' => 'El usuario no existe o no es trabajador'
        ];
    }
}
