<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExperienceRequest;
use App\Models\User;
use App\Services\ExperienceService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExperienceController extends Controller
{
    public function update(ExperienceRequest $request) {

        $experiences = $request->experiences;
        $user = User::findOrFail(Auth::user()->id);
        (new ExperienceService($experiences))->handle($user);
        return redirect()->route('dashboard');

    }
}
