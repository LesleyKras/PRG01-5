<?php

namespace App\Http\Controllers;

use App\Advertisement;
use App\Category;
use App\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
class AdvertisementController extends Controller
{
    public function getIndex(){
        $advertisements = Advertisement::orderBy('created_at', 'desc')->paginate(2);
        return view('advertisements.index', ['advertisements' => $advertisements]);
    }

    public function getAdvertisement($id){
        $advertisement = Advertisement::where('id', $id)->with('likes')->first();
        return view('advertisements.post', ['advertisement' => $advertisement]);
    }

    public function getLikeAdvertisement($id){
        $advertisement = Advertisement::find($id);
        $like = new Like();
        $advertisement->likes()->save($like);
        return redirect()->back();
    }

    public function getCreateAdvertisement(){
        $categorys = Category::all();
        return view('profile.create', ['categorys' => $categorys]);
    }

    public function createAdvertisement(Request $request){
        if(!Auth::check()){
            return redirect()->back();
        }
        $this->validate($request, [
            'title' => 'required|min:5',
            'description' => 'required|min:10'
        ]);

        $user = Auth::user();
        if(!$user) {
            return redirect()->back;
        }

        $advertisement = new Advertisement([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'price' => $request->input('price')
        ]);
        $user->advertisements()->save($advertisement);
        $advertisement->categorys()->attach($request->input('categorys') === null ? : $request->input('categorys'));
        return redirect()->route('profile.index')->with('info', 'Advertisement with title ' .$request->input('title'). ' succesfully created!');
    }

    public function updateAdvertisement(Request $request){
        if(!Auth::check()){
            return redirect()->back();
        }
        $this->validate($request, [
            'title' => 'required|min:5',
            'description' => 'required|min:10'
        ]);
        $advertisement = Advertisement::find($request->input('id'));
        if (Gate::denies('manipulate-advertisement', $advertisement)){
            return redirect()->back();
        }
        $advertisement->title = $request->input('title');
        $advertisement->description = $request->input('description');
        $advertisement->price = $request->input('price');
        $advertisement->save();
        $advertisement->categorys()->sync($request->input('categorys') === null ? : $request->input('categorys'));
        return redirect()->route('profile.index')->with('info', 'Advertisement with title ' .$request->input('title'). ' succesfully edited!');
    }

    public function getAdvertisementDelete($id){
        if(!Auth::check()){
            return redirect()->back();
        }
        $advertisement = Advertisement::find($id);
        if (Gate::denies('manipulate-advertisement', $advertisement)){
            return redirect()->back();
        }
        $advertisement->likes()->delete();
        $advertisement->categorys()->detach();
        $advertisement->delete();
        return redirect()->route('profile.index')->with('info', 'Advertisement succesfully deleted!');

    }

    public function getAdvertisementEdit($id){
        $advertisement = Advertisement::find($id);
        $categorys = Category::all();
        return view('profile.edit', ['advertisement' => $advertisement, 'advertisementId' => $id, 'categorys' => $categorys]);
    }


}
