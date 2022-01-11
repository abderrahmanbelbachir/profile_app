<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index() {
        if (\Illuminate\Support\Facades\Auth::user()) {
            return redirect('/dashboard');
        } else {
            return redirect('/register');
        }
    }
}
