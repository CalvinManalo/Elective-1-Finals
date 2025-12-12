<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create($role = 'student'): View
    {
        // pass selected role so the form can include it (and the store method can use it)
        return view('auth.register', compact('role'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request, $role = null): RedirectResponse
    {
        // ensure a valid role is present either from the route or the request body
        $allowed = ['student', 'alumni', 'employee'];
        $role = $role ?: $request->input('role', 'student');

        // set role back to request so the rest of the code can pick it
        $request->merge(['role' => $role]);

        // 'lowercase' isn't a standard Laravel validation rule — remove it to avoid errors
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'role' => ['required', 'string', "in:".implode(',', $allowed)],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        event(new Registered($user));

        Auth::login($user);

        // Redirect admins to admin dashboard, others to regular dashboard
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }
        
        return redirect(route('dashboard', absolute: false));
    }

    protected function redirectTo($user)
    {
        switch ($user->role) {
            case 'admin':
                return '/admin/dashboard';
            case 'employee':
                return '/employee/dashboard';
            case 'student':
                return '/student/dashboard';
             case 'alumni':
                return '/alumni/dashboard';
            default:
                return '/dashboard';
        }
    }
    
}
