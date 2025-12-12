<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alumni;
use App\Models\AlumniNomination;
use Illuminate\Support\Facades\Auth;

class AlumniController extends Controller
{
    // Show alumni page
    public function index()
    {
        $alumniList = Alumni::all();
        $alumniOfTheWeekId = cache('alumni_of_the_week');
        $alumniOfTheWeek = $alumniOfTheWeekId ? Alumni::find($alumniOfTheWeekId) : null;
        $isNominated = $alumniOfTheWeek && str_starts_with($alumniOfTheWeek->id_number, 'NOM-');
        $nominationMessage = null;
        if ($isNominated) {
            $nominationId = str_replace('NOM-', '', $alumniOfTheWeek->id_number);
            $nomination = AlumniNomination::find($nominationId);
            $nominationMessage = $nomination ? $nomination->message : null;
        }
        return view('alumni', compact('alumniList', 'alumniOfTheWeek', 'isNominated', 'nominationMessage'));
    }

    // Handle Alumni Registration
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'id_number' => 'required|string|max:50|unique:alumni,id_number',
            'course' => 'required|string|max:100',
            'batch' => 'required|integer|min:1900|max:' . date('Y'),
        ]);

        Alumni::create($request->only('name', 'id_number', 'course', 'batch'));

        // IMPORTANT:
        // This does NOT redirect to any voting page
        return back()->with('success', 'Alumni Card registration successful!');
    }

    // Handle Voting
    public function vote(Request $request)
    {
        $request->validate([
            'vote' => 'required|exists:alumni,id',
        ]);

        return back()->with('success', 'Your vote has been recorded!');
    }

    // Delete alumni
    public function destroy($id)
    {
        $alumni = Alumni::findOrFail($id);
        $alumni->delete();

        return back()->with('success', 'Alumni deleted successfully!');
    }

    // Handle Alumni Nomination
    public function nominate(Request $request)
    {
        $request->validate([
            'alumni_name' => 'required|string|max:255',
            'course' => 'required|string|max:100',
            'batch' => 'required|integer|min:1900|max:' . date('Y'),
            'message' => 'nullable|string|max:500',
        ]);

        AlumniNomination::create([
            'user_id' => Auth::id(),
            'alumni_name' => $request->alumni_name,
            'course' => $request->course,
            'batch' => $request->batch,
            'message' => $request->message,
        ]);

        return back()->with('success', 'Nomination submitted successfully!');
    }

    // Show home page
    public function home()
    {
        $alumniOfTheWeekId = cache('alumni_of_the_week');
        $alumniOfTheWeek = $alumniOfTheWeekId ? Alumni::find($alumniOfTheWeekId) : null;
        $isNominated = $alumniOfTheWeek && str_starts_with($alumniOfTheWeek->id_number, 'NOM-');
        $nominationMessage = null;
        if ($isNominated) {
            $nominationId = str_replace('NOM-', '', $alumniOfTheWeek->id_number);
            $nomination = AlumniNomination::find($nominationId);
            $nominationMessage = $nomination ? $nomination->message : null;
        }
        return view('home', compact('alumniOfTheWeek', 'isNominated', 'nominationMessage'));
    }
}



