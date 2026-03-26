<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Services\AuthService;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|max:255',
            'lastname' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'phone_number' => 'required|max:255',
            'profile_picture' => 'image|mimes:jpg,jpeg,png,webp|max:20480',
            'password' => 'required'
        ]);

        if($validator->fails()){
            return response()->json([
                'message' => 'Error en la validacion de datos',
                'errors' => $validator->errors(),
                'status' => 400
            ], 400);
        }

        $user = $this->authService->registerUser(
            $request->except('profile_picture'),
            $request->file('profile_picture')
        );

        if(!$user){
            return response()->json([
                'message' => 'Error al crear usuario',
                'status' => 500
            ], 500);
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
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = $this->authService->loginUser($request->only('email', 'password'));

        if (!$user) {
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

    public function isTrabajador($id)
    {
        $trabajador = $this->authService->getTrabajadorByUserId($id);

        if($trabajador){
            return $trabajador;
        }

        return [
            'message' => 'El usuario no existe o no es trabajador'
        ];
    }

    public function getUser($user_id)
    {
        $datos = $this->authService->getUserData($user_id);

        if (!$datos) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }

        return response()->json([
            'datos' => $datos
        ], 200);
    }
    
    public function updateUser(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'lastname' => 'required|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'phone_number' => 'required|max:255',
            'profile_picture' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:20480'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error en la validación de datos',
                'errors' => $validator->errors(),
                'status' => 400
            ], 400);
        }

        $removePicture = $request->has('remove_profile_picture') && $request->remove_profile_picture == "1";

        $user = $this->authService->updateUserData(
            $id,
            $request->except('profile_picture'),
            $request->file('profile_picture'),
            $removePicture
        );

        if (!$user) {
            return response()->json([
                'message' => 'Usuario no encontrado',
                'status' => 404
            ], 404);
        }

        return response()->json([
            'message' => 'Usuario actualizado correctamente',
            'user' => $user,
            'status' => 200
        ], 200);
    }

    public function verifyEmail(Request $request)
    {   
        $request->validate([
            'email' => 'required|email',
            'verification_code' => 'required|digits:4'
        ]);

        $user = $this->authService->verifyUserEmail($request->all());

        if (!$user) {
            return response()->json(['message' => 'Código incorrecto o usuario no encontrado'], 400);
        }

        return response()->json(['message' => 'Correo verificado exitosamente.', 'user' => $user]);
    }
}
