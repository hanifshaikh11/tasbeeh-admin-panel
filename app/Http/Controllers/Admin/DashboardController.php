<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers   = User::role('user')->count();
        $totalAdmins  = User::role('admin')->count();
        $activeUsers  = User::role('user')->where('status',1)->count();
        $blockedUsers = User::role('user')->where('status',0)->count();

        return view('dashboard', compact(
            'totalUsers',
            'totalAdmins',
            'activeUsers',
            'blockedUsers'
        ));
    }
}
