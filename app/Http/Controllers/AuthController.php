<?php

namespace App\Http\Controllers;

use App\Models\Trabajador;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
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
            'profile_picture' => 'image|mimes:jpg,jpeg,png,webp|max:20480', // máx. 20MB
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
    public function getUser($user_id)
    {
        $usuario = User::find($user_id);
        if (!$usuario) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }
        $usuario->profile_picture = $usuario->profile_picture
            ? asset(Storage::url($usuario->profile_picture))
            : null;

       
        $trabajador = Trabajador::where('user_id', $user_id)->first();
        if ($trabajador) {
            // Cargamos la relación *una vez* y después mutamos el campo
            $trabajador->load('user');
            $trabajador->user->profile_picture = $usuario->profile_picture;

            return response()->json([
                'datos' => $trabajador
            ], 200);
        }
        //creamos un objeto que contenta user para adeacuerdos al type del front
        $res = [
            'user' => $usuario,
        ];
        // Si no hay trabajador, devolvemos el usuario formateado
        return response()->json([
            'datos' => $res
        ], 200);
    }
    
    public function updateUser(Request $request, $id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json([
                'message' => 'Usuario no encontrado',
                'status' => 404
            ], 404);
        }

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

        $user->name = $request->name;
        $user->lastname = $request->lastname;
        $user->email = $request->email;
        $user->phone_number = $request->phone_number;

        // Eliminar imagen si se solicita
        if ($request->has('remove_profile_picture') && $request->remove_profile_picture == "1") {
            if ($user->profile_picture && Storage::disk('public')->exists($user->profile_picture)) {
                Storage::disk('public')->delete($user->profile_picture);
            }
            $user->profile_picture = null;
        }

        // Subir nueva imagen si se envía
        if ($request->hasFile('profile_picture')) {
            // Eliminar imagen anterior si existe
            if ($user->profile_picture && Storage::disk('public')->exists($user->profile_picture)) {
                Storage::disk('public')->delete($user->profile_picture);
            }
            // Guardar nueva imagen
            $file = $request->file('profile_picture');
            $filePath = $file->store('profile_pictures', 'public');
            $user->profile_picture = $filePath;
        }

        $user->save();

        // Formatear la imagen para la respuesta
        $user->profile_picture = $user->profile_picture
            ? asset(Storage::url($user->profile_picture))
            : null;

        return response()->json([
            'message' => 'Usuario actualizado correctamente',
            'user' => $user,
            'status' => 200
        ], 200);
    }
}
