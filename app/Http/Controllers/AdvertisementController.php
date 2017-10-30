<?php

namespace App\Http\Controllers;

use App\Advertisement;
use App\Category;
use App\Like;
use Illuminate\Http\Request;

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
        $this->validate($request, [
            'title' => 'required|min:5',
            'description' => 'required|min:10'
        ]);

        $advertisement = new Advertisement([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'price' => $request->input('price')
        ]);
        $advertisement->save();
        $advertisement->categorys()->attach($request->input('categorys') === null ? : $request->input('categorys'));
        return redirect()->route('profile.index')->with('info', 'Advertisement with title ' .$request->input('title'). ' succesfully created!');
    }

    public function updateAdvertisement(Request $request){
        $this->validate($request, [
            'title' => 'required|min:5',
            'description' => 'required|min:10'
        ]);
        $advertisement = Advertisement::find($request->input('id'));
        $advertisement->title = $request->input('title');
        $advertisement->description = $request->input('description');
        $advertisement->price = $request->input('price');
        $advertisement->save();
        $advertisement->categorys()->sync($request->input('categorys') === null ? : $request->input('categorys'));
        return redirect()->route('profile.index')->with('info', 'Advertisement with title ' .$request->input('title'). ' succesfully edited!');
    }

    public function getAdvertisementDelete($id){
        $advertisement = Advertisement::find($id);
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
