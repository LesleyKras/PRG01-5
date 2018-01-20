<?php

namespace App\Http\Controllers;


use App\Role;
use App\User;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function getIndex(){
        if(!Auth::check()){
            return redirect()->route('auth.signin')->with('info', 'You need to be logged in to view this page.');
        }

        $user = Auth::user();
        if(!$user) {
            return redirect()->back;
        }

        $advertisements = User::find($user->id)->advertisements()->get();
        $role = Role::find($user->role_id);
        return view('profile.index', ['advertisements' => $advertisements, 'user' => $user, 'roles' => $role]);
    }
}
