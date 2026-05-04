<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Waitlist;

class WaitlistController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:waitlists,email'
        ], [
            'email.required' => 'Please enter your email',
            'email.email' => 'Enter a valid email address',
            'email.unique' => 'You are already on the waitlist 😉'
        ]);

        Waitlist::create([
            'email' => $request->email
        ]);

        return back()->with('success', 'You are on the waitlist 🚀');
    }

    // Admin Side
    public function destroy($id)
    {
        $item = Waitlist::findOrFail($id);
        $item->delete();
        return back()->with('success', 'Deleted successfully');
    }


    // Admin Side
    public function index(Request $request)
    {
        $search = $request->search;
        $waitlists = Waitlist::when($search, function ($q) use ($search) {
            $q->where('email', 'like', "%$search%");
        })
            ->latest()
            ->paginate(10);

        return view('admin.waitlist.index', compact('waitlists', 'search'));
    }
}
