<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (Auth::check()) {
            return redirect()->route('products.index');
        }
        return view('login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'loginIdentifier' => 'required|string',
            'password' => 'required|string',
        ]);

        $identifier = trim($request->loginIdentifier);
        $fieldType = filter_var($identifier, FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';
        $remember = $request->boolean('remember');

        $credentials = [
            $fieldType => $identifier,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            $user = Auth::user();

            if ($request->wantsJson() || $request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Welcome back, ' . $user->name . '!',
                    'user' => [
                        'id' => $user->id,
                        'name' => $user->name,
                        'email' => $user->email,
                        'phone' => $user->phone,
                        'role' => $user->role,
                    ],
                    'redirect' => $user->role === 'Admin' ? route('admin.dashboard') : route('products.index'),
                ]);
            }

            if ($user->role === 'Admin') {
                return redirect()->intended(route('admin.dashboard'))->with('success', 'Welcome to Atelier Admin Dashboard, ' . $user->name);
            }

            return redirect()->intended(route('products.index'))->with('success', 'Welcome back, ' . $user->name);
        }

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => false,
                'message' => 'The provided credentials do not match our artisanal records.',
            ], 422);
        }

        return back()->withErrors([
            'loginIdentifier' => 'The provided credentials do not match our records.',
        ])->onlyInput('loginIdentifier');
    }

    public function showRegister()
    {
        if (Auth::check()) {
            return redirect()->route('products.index');
        }
        return view('register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'phone' => 'nullable|string|max:20',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'role' => 'Collector',
            'status' => 'Active',
            'password' => Hash::make($validated['password']),
        ]);

        Auth::login($user);
        $request->session()->regenerate();

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Welcome to Himalayan Atelier, ' . $user->name . '!',
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'phone' => $user->phone,
                    'role' => $user->role,
                ],
                'redirect' => route('products.index'),
            ]);
        }

        return redirect()->route('products.index')->with('success', 'Welcome to Himalayan Atelier, ' . $user->name . '!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'You have been signed out successfully.',
                'redirect' => route('home'),
            ]);
        }

        return redirect()->route('home')->with('info', 'You have been signed out.');
    }
}
