<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
     public function index()
    {
        $users = User::all();
        return response()->json($users);
    }

    public function store(StoreUserRequest $request)
{
    $validated = $request->validated();

    $user = User::create([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'password' => Hash::make($validated['password']),
    ]);

    return response()->json([
        'message' => 'User created successfully.',
        'user' => $user,
    ], 201);
}

public function show($id)
{
    $user = User::findOrFail($id);

    return response()->json($user);
}

public function update(UpdateUserRequest $request, $id)
{
    $user = User::findOrFail($id);

    $validated = $request->validated();

    $user->name = $validated['name'];
    $user->email = $validated['email'];

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
    $user->delete();

    return response()->json([
        'message' => 'User deleted successfully.',
    ]);
}
}
