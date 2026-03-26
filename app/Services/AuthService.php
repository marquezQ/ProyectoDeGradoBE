<?php



namespace App\Services;

use App\Models\User;
use App\Models\Trabajador;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
// use Illuminate\Support\Facades\Mail;
// use App\Mail\VerificationMail;

class AuthService
{
    public function registerUser(array $data, $file = null)
    {
        $verificationCode = str_pad(random_int(0, 9999), 4, '0', STR_PAD_LEFT);

        $filePath = '';
        if ($file) {
            $filePath = $file->store('profile_pictures', 'public');
        }

        $user = User::create([
            'name' => $data['name'],
            'lastname' => $data['lastname'],
            'email' => $data['email'],
            'phone_number' => $data['phone_number'],
            'profile_picture' => $filePath,
            'password' => $data['password'],
            'email_verified' => false,
            'verification_code' => $verificationCode,
        ]);

        if ($user) {
            // Mail::to($user->email)->send(new VerificationMail($verificationCode));
        }

        return $user;
    }

    public function loginUser(array $credentials)
    {
        $user = User::where('email', $credentials['email'])->first();

        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            return null;
        }

        return $user;
    }

    public function getTrabajadorByUserId($userId)
    {
        return Trabajador::where('user_id', $userId)->first();
    }

    public function getUserData($userId)
    {
        $usuario = User::find($userId);
        if (!$usuario) {
            return null;
        }

        $usuario->profile_picture = $usuario->profile_picture
            ? asset(Storage::url($usuario->profile_picture))
            : null;

        $trabajador = Trabajador::where('user_id', $userId)->first();
        if ($trabajador) {
            $trabajador->load('user');
            $trabajador->user->profile_picture = $usuario->profile_picture;

            return $trabajador;
        }

        return [
            'user' => $usuario,
        ];
    }

    public function updateUserData($id, array $data, $file = null, $removePicture = false)
    {
        $user = User::find($id);
        if (!$user) {
            return null;
        }

        $user->name = $data['name'];
        $user->lastname = $data['lastname'];
        $user->email = $data['email'];
        $user->phone_number = $data['phone_number'];

        if ($removePicture) {
            if ($user->profile_picture && Storage::disk('public')->exists($user->profile_picture)) {
                Storage::disk('public')->delete($user->profile_picture);
            }
            $user->profile_picture = null;
        }

        if ($file) {
            if ($user->profile_picture && Storage::disk('public')->exists($user->profile_picture)) {
                Storage::disk('public')->delete($user->profile_picture);
            }
            $filePath = $file->store('profile_pictures', 'public');
            $user->profile_picture = $filePath;
        }

        $user->save();

        $user->profile_picture = $user->profile_picture
            ? asset(Storage::url($user->profile_picture))
            : null;

        return $user;
    }

    public function verifyUserEmail(array $data)
    {
        $user = User::where('email', $data['email'])
            ->where('verification_code', $data['verification_code'])
            ->first();

        if (!$user) {
            return null;
        }

        $user->email_verified = true;
        $user->verification_code = null;
        $user->save();

        return $user;
    }
}
