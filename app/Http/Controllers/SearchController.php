<?php

namespace App\Http\Controllers;

use App\Advertisement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{
    public function search(Request $request){
            if(!Auth::check()){
                return redirect()->route('auth.signin')->with('info', 'You need to be logged in to search this page.');
            }
            $search = $request->input('key');
            $results = Advertisement::where('title','like','%'.$search.'%')->orWhere('description','like','%'.$search.'%')->get();

            return view('advertisements.index', ['advertisements' => $results]);
        }
}
