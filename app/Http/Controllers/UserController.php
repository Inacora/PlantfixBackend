<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
public function update(UpdateUserRequest $request, $id)
{
    $user = User::findOrFail($id);

    if (Auth::id() !== $user->id) {
        return response()->json(['error' => 'No autorizado.'], 403);
    }

    // Filtrar sólo los campos con valor no nulo ni vacío
    $filtered = array_filter($request->all(), function ($value) {
        return !is_null($value) && $value !== '';
    });

    $validated = $request->validate($request->rules(), [], $request->messages(), $filtered);

    if (isset($validated['name'])) {
        $user->name = $validated['name'];
    }
    if (isset($validated['email'])) {
        $user->email = $validated['email'];
    }
    if (!empty($validated['password'])) {
        $user->password = Hash::make($validated['password']);
    }

    $user->save();

    return response()->json([
        'message' => 'User updated successfully.',
        'user' => $user,
    ]);
}

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // Validar que el usuario autenticado sea el mismo que quiere eliminar
        if (Auth::id() !== $user->id) {
            return response()->json(['error' => 'No autorizado.'], 403);
        }

        $user->delete();

        return response()->json([
            'message' => 'User deleted successfully.',
        ]);
    }
}
