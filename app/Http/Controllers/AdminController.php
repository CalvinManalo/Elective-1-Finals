<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Alumni;
use App\Models\Post;
use App\Models\AlumniNomination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    /**
     * Show admin dashboard
     */
    public function index()
    {
        // Check if user is authenticated and is admin
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized access.');
        }

        // Get comprehensive statistics for monitoring
        $stats = [
            'total_users' => User::count(),
            'total_alumni' => Alumni::count(),
            'total_students' => User::where('role', 'student')->count(),
            'total_employees' => User::where('role', 'employee')->count(),
            'total_admins' => User::where('role', 'admin')->count(),
            'total_alumni_users' => User::where('role', 'alumni')->count(),
            'users_today' => User::whereDate('created_at', today())->count(),
            'users_this_week' => User::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count(),
            'users_this_month' => User::whereMonth('created_at', now()->month)->whereYear('created_at', now()->year)->count(),
            'recent_users' => User::latest()->take(10)->get(),
            'recent_alumni' => Alumni::latest()->take(10)->get(),
            'new_registrations_today' => User::whereDate('created_at', today())->count(),
            'alumni_registrations_today' => Alumni::whereDate('created_at', today())->count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }

    /**
     * Show all users
     */
    public function users()
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized access.');
        }

        $users = User::latest()->paginate(15);
        return view('admin.users', compact('users'));
    }

    /**
     * Delete a user
     */
    public function deleteUser($id)
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized access.');
        }

        $user = User::findOrFail($id);
        
        // Prevent admin from deleting themselves
        if ($user->id === Auth::id()) {
            return back()->with('error', 'You cannot delete your own account.');
        }

        $user->delete();
        return back()->with('success', 'User deleted successfully.');
    }

    /**
     * Show all alumni
     */
    public function alumni()
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized access.');
        }

        $alumni = Alumni::latest()->paginate(15);
        $nominations = AlumniNomination::with('user')->latest()->get();
        $alumniOfTheWeekId = cache('alumni_of_the_week');
        $alumniOfTheWeek = $alumniOfTheWeekId ? Alumni::find($alumniOfTheWeekId) : null;
        return view('admin.alumni', compact('alumni', 'nominations', 'alumniOfTheWeek'));
    }

    /**
     * Delete an alumni record
     */
    public function deleteAlumni($id)
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized access.');
        }

        $alumni = Alumni::findOrFail($id);
        $alumni->delete();
        return back()->with('success', 'Alumni record deleted successfully.');
    }

    /**
     * Show posts management
     */
    public function posts()
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized access.');
        }

        $posts = Post::with('user')->latest()->paginate(15);
        return view('admin.posts', compact('posts'));
    }

    /**
     * Delete a post
     */
    public function deletePost($id)
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized access.');
        }

        $post = Post::findOrFail($id);
        $post->delete();
        return back()->with('success', 'Post deleted successfully.');
    }

    /**
     * Set alumni of the week
     */
    public function setAlumniOfTheWeek(Request $request)
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized access.');
        }

        $request->validate([
            'alumni_id' => 'required|exists:alumni,id'
        ]);

        cache(['alumni_of_the_week' => $request->alumni_id], now()->addWeek());

        return back()->with('success', 'Alumni of the Week set successfully.');
    }

    /**
     * Set random alumni of the week
     */
    public function setRandomAlumniOfTheWeek()
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized access.');
        }

        $randomAlumni = Alumni::inRandomOrder()->first();
        if ($randomAlumni) {
            cache(['alumni_of_the_week' => $randomAlumni->id], now()->addWeek());
            return back()->with('success', 'Random Alumni of the Week set successfully.');
        }

        return back()->with('error', 'No alumni available to set.');
    }

    /**
     * Set alumni of the week from nomination
     */
    public function setAlumniOfTheWeekFromNomination(Request $request)
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized access.');
        }

        $request->validate([
            'nomination_id' => 'required|exists:alumni_nominations,id'
        ]);

        $nomination = AlumniNomination::findOrFail($request->nomination_id);

        // Create alumni record from nomination
        $alumni = Alumni::create([
            'name' => $nomination->alumni_name,
            'course' => $nomination->course,
            'batch' => $nomination->batch,
            'id_number' => 'NOM-' . $nomination->id, // Generate a unique ID for nominated alumni
        ]);

        // Set as alumni of the week
        cache(['alumni_of_the_week' => $alumni->id], now()->addWeek());

        return back()->with('success', 'Alumni of the Week set from nomination successfully.');
    }

    /**
     * Update user role
     */
    public function updateUserRole(Request $request, $id)
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized access.');
        }

        $request->validate([
            'role' => 'required|in:student,alumni,employee,admin'
        ]);

        $user = User::findOrFail($id);
        $user->role = $request->role;
        $user->save();

        return back()->with('success', 'User role updated successfully.');
    }
}

