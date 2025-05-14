<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    // Solo admins pueden acceder a estas funciones (añade middleware en rutas)

    public function index()
    {
        return User::all(); // puedes paginar si es necesario
    }

    public function updateRole(Request $request, User $user)
    {
        $request->validate([
            'role' => ['required', Rule::in(['user', 'admin'])],
        ]);

        $user->role = $request->role;
        $user->save();

        return response()->json(['message' => 'Role updated successfully']);
    }
}
