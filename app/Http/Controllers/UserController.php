<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index() {
        $users = User::all();
        return response()->json($users);
    }

    public function show($id) {
        $user = User::find($id);
        return response()->json($user);
    }

    public function store(Request $request) {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->save();
        return response()->json($user);
    }

    public function update(Request $request, $id) {
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->save();
        return response()->json($user);
    }

    public function destroy($id) {
        $user = User::find($id);
        $user->delete();
        return response()->json($user);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Credenciales inválidas.',
                'status' => 401
            ], 401);
        }

        return response()->json([
            'message' => 'Login exitoso',
            'user' => $user,
            'status' => 200
        ], 200);
    }

}
