<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrganizationRequest;
use App\Models\User;
use App\Services\OrganizationService;
use Illuminate\Support\Facades\Auth;

class OrganizationController extends Controller
{
    public function update(OrganizationRequest $request) {

        $organizations = $request->organizations;
        $user = User::findOrFail(Auth::user()->id);
        (new OrganizationService($organizations))->handle($user);
        return redirect()->route('dashboard');

    }
}
