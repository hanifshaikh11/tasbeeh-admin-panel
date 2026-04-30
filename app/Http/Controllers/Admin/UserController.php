<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;


class UserController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
        $users = User::when($search, function ($q) use ($search) {
            $q->where('name', 'like', "%$search%")
                ->orWhere('email', 'like', "%$search%");
        })->latest()->paginate(10);
        return view('admin.users.index', compact('users', 'search'));
    }

    public function toggleStatus_old($id)
    {
        $user = User::findOrFail($id);
        $user->status = !$user->status;
        $user->save();
        return redirect()->route('users.index')
            ->with('success', 'User status updated');
    }

    public function toggleStatus($id)
    {
        $user = User::findOrFail($id);
        $user->status = !$user->status;
        $user->save();

        return response()->json([
            'success' => true,
            'status' => $user->status,
            'message' => $user->status
                ? 'User unblocked successfully'
                : 'User blocked successfully'
        ]);
    }
}
