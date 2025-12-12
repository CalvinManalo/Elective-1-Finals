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
    public function create($role = 'student'): View
{
    return view('auth.login', compact('role'));
}

    /**
     * Handle an incoming authentication request.
     */
    public function store(Request $request, $role = null): RedirectResponse
{
    $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    if (!Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
        return back()->withErrors([
            'email' => 'Invalid credentials.',
        ]);
    }

    $request->session()->regenerate();

    $user = Auth::user();

    // ✅ Check if role matches the login route
    if ($role && $role !== $user->role) {
        Auth::logout();
        return redirect('/login')->withErrors(['role' => 'Role mismatch.']);
    }

    // Redirect admins to admin dashboard, others to regular dashboard
    if ($user->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }
    
    // Redirect to the canonical dashboard route. This avoids 404s when role-specific
    // dashboard routes (e.g. /student/dashboard) are not defined. If you want role-
    // specific home pages later, create the routes or extend this logic.
    return redirect()->route('dashboard');
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
