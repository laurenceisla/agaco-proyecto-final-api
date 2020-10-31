<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'device_name' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['Las credenciales brindadas son incorrectas.'],
            ]);
        }

        $plainTextToken = $user->createToken($request->device_name)->plainTextToken;

        return [
            "id" => $user->id,
            "nombre" => $user->nombre,
            "email" => $user->email,
            "perfil" => $user->perfil->nombre,
            "token" => $plainTextToken,
        ];
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response('Logout correcto', 200);
    }
}
