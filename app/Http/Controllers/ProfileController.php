<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
use App\Models\Experience;
use App\Models\User;
use App\Services\ExperienceService;
use App\Services\FaireUneDemande\StepOne;
use App\Services\OrganizationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index() {
        $user = \Illuminate\Support\Facades\Auth::user();
        $user->load('experiences');
        $user->load('organizations');
        return $user;
    }

    public function store() {

    }

    public function show() {

    }

    public function edit() {

    }

    public function update(UpdateProfileRequest $request) {

        $userInputs = $request->only(['first_name' , 'last_name' , 'email']);
        $experiences = $request->experiences;
        $organizations = $request->organizations;
        $user = User::findOrFail(Auth::user()->id);
        $user->update($userInputs);

        (new ExperienceService($experiences))->handle($user);

        (new OrganizationService($organizations))->handle($user);

        return redirect()->route('dashboard');
    }

}
