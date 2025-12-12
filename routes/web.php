<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AlumniController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

// register-selection: small public page where user picks which role to register as
Route::get('/register-selection', function () {
    return view('register-selection');
});

// helper route: if a user is already authenticated and clicks a login role link,
// log them out and redirect them to the role login page so they actually see the form.
Route::get('/switch-login/{role}', function ($role) {
    // prevent invalid role values — keep list in sync with RegisteredUserController
    $allowed = ['student', 'alumni', 'employee', 'admin'];
    if (! in_array($role, $allowed)) {
        abort(404);
    }

    if (Auth::check()) {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
    }

    return redirect()->route('login', ['role' => $role]);
});

// Same behaviour for register: let signed-in users switch accounts by logging out
Route::get('/switch-register/{role}', function ($role) {
    $allowed = ['student', 'alumni', 'employee'];
    if (! in_array($role, $allowed)) {
        abort(404);
    }

    if (Auth::check()) {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
    }

    return redirect()->route('register', ['role' => $role]);
});

Route::get('/dashboard', function () {
    // Redirect admins to admin dashboard
    if (Auth::check() && Auth::user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'dashboard'])->name('profile.dashboard');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Alumni Platform Routes
Route::middleware('auth')->group(function () {
    Route::get('/home', [AlumniController::class, 'home'])->name('home');

    Route::get('/opportunities', function () {
        return view('opportunities');
    });

    Route::get('/forum', function () {
        return view('forum');
    });

    Route::get('/calendar', function () {
        return view('calendar');
    });
});

// Alumni Routes
Route::get('/alumni', [AlumniController::class, 'index'])->name('alumni.index');
Route::post('/alumni/register', [AlumniController::class, 'register'])->name('alumni.register');
Route::post('/alumni/nominate', [AlumniController::class, 'nominate'])->name('alumni.nominate');
Route::post('/alumni/vote', [AlumniController::class, 'vote'])->name('alumni.vote');
Route::delete('/alumni/{id}', [AlumniController::class, 'destroy'])->name('alumni.destroy');

// Post Routes
Route::middleware('auth')->group(function () {
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
});

// Admin Routes (protected by auth middleware and role check in controller)
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::get('/users', [AdminController::class, 'users'])->name('users');
    Route::get('/alumni', [AdminController::class, 'alumni'])->name('alumni');
    Route::get('/posts', [AdminController::class, 'posts'])->name('posts');
    Route::delete('/users/{id}', [AdminController::class, 'deleteUser'])->name('deleteUser');
    Route::delete('/alumni/{id}', [AdminController::class, 'deleteAlumni'])->name('deleteAlumni');
    Route::delete('/posts/{id}', [AdminController::class, 'deletePost'])->name('deletePost');
    Route::post('/users/{id}/role', [AdminController::class, 'updateUserRole'])->name('updateRole');
    Route::post('/set-alumni-of-the-week', [AdminController::class, 'setAlumniOfTheWeek'])->name('setAlumniOfTheWeek');
    Route::get('/set-random-alumni-of-the-week', [AdminController::class, 'setRandomAlumniOfTheWeek'])->name('setRandomAlumniOfTheWeek');
    Route::post('/set-alumni-of-the-week-from-nomination', [AdminController::class, 'setAlumniOfTheWeekFromNomination'])->name('setAlumniOfTheWeekFromNomination');
});

require __DIR__.'/auth.php';
