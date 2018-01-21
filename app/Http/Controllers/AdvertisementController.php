<?php

namespace App\Http\Controllers;

use App\Advertisement;
use App\Category;
use App\Like;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
class AdvertisementController extends Controller
{
    public function getIndex(){
        if(!Auth::check()){
            return redirect()->route('auth.signin')->with('info', 'You need to be logged in to view this page.');
        }
        $advertisements = Advertisement::orderBy('created_at', 'desc')->paginate(5);
        return view('advertisements.index', ['advertisements' => $advertisements]);
    }

    public function getAdvertisement($id){
        $advertisement = Advertisement::where('id', $id)->with('likes')->first();
        return view('advertisements.post', ['advertisement' => $advertisement]);
    }

    public function getLikeAdvertisement($id){
        if(!Auth::check()){
            return redirect()->route('auth.signin')->with('info', 'You need to be logged in to like a post.');
        }
        $user = Auth::user();
        $advertisement = Advertisement::find($id);

        if(Like::where('advertisement_id', '=', $advertisement->id)->where('user_id', '=', $user->id)->count()>0){
            $like = Like::where('advertisement_id', '=', $advertisement->id)->where('user_id', '=', $user->id);
            $like->delete();
            return redirect()->back();
        }
        else if(Like::where('advertisement_id', '=', $advertisement->id)->where('user_id', '=', $user->id)->count()<=0){
            $like = new Like();
            $like->user_id = $user->id;
            $advertisement->likes()->save($like);
            return redirect()->back();
        }

    }

    public function getCreateAdvertisement(){
        $categorys = Category::all();
        return view('advertisements.create', ['categorys' => $categorys]);
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
            'price' => $request->input('price'),
            'active' => true
        ]);
        $user->advertisements()->save($advertisement);
        $advertisement->categorys()->attach($request->input('categorys') === null ? : $request->input('categorys'));
        return redirect()->route('advertisements.index')->with('info', 'Advertisement with title ' .$request->input('title'). ' succesfully created!');
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
            return redirect()->route('profile.index')->with('info', 'You do not have the rights to modify this item.');
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
        $user = Auth::user();
        $advertisement = Advertisement::find($id);
        if (Gate::denies('manipulate-advertisement', $advertisement, $user)){
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

        if (Gate::denies('manipulate-advertisement', $advertisement)){
            return redirect()->route('profile.index')->with('info', 'You do not have the rights to modify this item.');
        }
        return view('advertisements.edit', ['advertisement' => $advertisement, 'advertisementId' => $id, 'categorys' => $categorys]);
    }

    public function toggleActiveAdvertisement($id){
        if(!Auth::check()){
            return redirect()->route('auth.signin')->with('info', 'You need to be logged in to edit a post.');
        }
        $advertisement = Advertisement::find($id);

        if($advertisement->active){
            $advertisement->active = false;
            $advertisement->save();
            return redirect()->route('profile.index')->with('info', 'Advertisement with title ' .$advertisement->title. ' succesfully disabled!');
        }
        else if(!$advertisement->active){
            $advertisement->active = true;
            $advertisement->save();
            return redirect()->route('profile.index')->with('info', 'Advertisement with title ' .$advertisement->title. ' succesfully enabled!');
        }

    }


}
