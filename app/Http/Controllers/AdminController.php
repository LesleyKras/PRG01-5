<?php

namespace App\Http\Controllers;

use App\Advertisement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class AdminController extends Controller
{
    public function getIndex(){
        if(!Auth::check()){
            return redirect()->route('auth.signin')->with('info', 'You need to be logged in to view this page.');
        }
        $user = Auth::user();
        if (Gate::denies('admin-rights', $user)){
            return redirect()->route('profile.index')->with('info', 'You are not authorized to view this page.');
        }

        $user = Auth::user();
        if(!$user) {
            return redirect()->back;
        }

        $advertisements = Advertisement::all();
        return view('admin.index', ['advertisements' => $advertisements, 'user' => $user]);
    }
}
