<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function showForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        // 1️⃣ Validation
        $validated = $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'date_of_birth' => 'nullable|date',
            'province' => 'nullable|string|max:100',
            'gender' => 'nullable|string|max:20',
            'phone_number' => 'nullable|string|max:20',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // 2️⃣ Création de l'utilisateur
        $user = User::create([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'date_of_birth' => $validated['date_of_birth'] ?? null,
            'province' => $validated['province'] ?? null,
            'gender' => $validated['gender'] ?? null,
            'phone_number' => $validated['phone_number'] ?? null,
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        // 3️⃣ Connexion automatique
        Auth::login($user);

        // 4️⃣ Redirection vers la page utilisateur
        return redirect()->route('user.dashboard')->with('success', 'Bienvenue sur votre espace personnel !');
    }

    public function showDashboard()
    {
        $totalUsers = User::count();
    }

}
