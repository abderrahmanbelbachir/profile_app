<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index() {
        $user = \Illuminate\Support\Facades\Auth::user();
        $user->load('experiences');
        $user->load('organizations');
        return Inertia::render('Dashboard' , [
            'user' => $user
        ]);
    }
}
