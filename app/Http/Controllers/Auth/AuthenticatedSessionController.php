<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        // =================================================================
        // INI ADALAH LOGIKA PENGALIHAN (REDIRECT) YANG BENAR
        // =================================================================
        
        $user = $request->user();
        $redirectPath = '';

        if ($user->role === 'admin') {
            // Arahkan admin ke dashboard admin (halaman CRUD)
            // Kita gunakan route('admin.rentals.index') sebagai dashboard admin
            $redirectPath = route('admin.rentals.index');
        } else {
            // Arahkan user biasa ke dashboard user
            $redirectPath = route('dashboard');
        }

        // intended() akan mengarahkan ke halaman yang dituju sebelumnya, 
        // atau ke $redirectPath jika datang langsung ke login.
        return redirect()->intended($redirectPath);

        // =================================================================
        // AKHIR DARI LOGIKA PENGALIHAN
        // =================================================================
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}