<?php

namespace App\Http\Controllers;

use App\Advertisement;
use Illuminate\Http\Request;

class AdvertisementController extends Controller
{
    public function getIndex(){
        $advertisements = Advertisement::orderBy('created_at', 'desc')->get();
        return view('advertisements.index', ['advertisements' => $advertisements]);
    }

    public function getAdvertisement($id){
        $advertisement = Advertisement::find($id);
        return view('advertisements.post', ['advertisement' => $advertisement]);
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
        return redirect()->route('profile.index')->with('info', 'Advertisement with title ' .$request->input('title'). ' succesfully edited!');
    }

    public function getAdvertisementDelete($id){
        $advertisement = Advertisement::find($id);
        $advertisement->delete();
        return redirect()->route('profile.index')->with('info', 'Advertisement succesfully deleted!');

    }

    public function getAdvertisementEdit($id){
        $advertisement = Advertisement::find($id);
        return view('profile.edit', ['advertisement' => $advertisement, 'advertisementId' => $id]);
    }


}
