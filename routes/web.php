<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [
    'uses' => 'HomeController@getIndex',
    'as' => 'home.index'
]);

// advertisements routing
Route::group(['prefix' => 'advertisements'], function() {
    Route::get('', [
        'uses' => 'AdvertisementController@getIndex',
        'as' => 'advertisements.index'
    ]);

    Route::get('/{id}', [
        'uses' => 'AdvertisementController@getAdvertisement'
    ])->name('advertisements.post');

    Route::get('/{id}/like', [
        'uses' => 'AdvertisementController@getLikeAdvertisement'
    ])->name('advertisements.like');


    Route::get('/delete/{id}', [
        'uses' => 'AdvertisementController@getAdvertisementDelete',
        'as' => 'advertisements.delete'
    ]);

});

// create advertisement routing
Route::group(['prefix' => 'create'], function() {
    Route::get('', [
        'uses' => 'AdvertisementController@getCreateAdvertisement',
        'as' => 'advertisements.create'
    ]);

    Route::post('', [
        'uses' => 'AdvertisementController@createAdvertisement',
        'as' => 'advertisements.index'
    ])->name('advertisements.create');
});

// edit advertisement routing
Route::group(['prefix' => 'edit'], function() {
    Route::get('{id}', [
        'uses' => 'AdvertisementController@getAdvertisementEdit',
        'as' => 'advertisements.edit'
    ]);

    Route::post('/edit', [
        'uses' => 'AdvertisementController@updateAdvertisement',
        'as' => 'advertisements.update'
    ]);
});

// profile routing
Route::group(['prefix' => 'profile'], function() {
    Route::get('', [
        'uses' => 'ProfileController@getIndex',
        'as' => 'profile.index'
    ]);
});

Route::get('/categories', function () {
    return view('categories.index');
})->name('categories.index');

Auth::routes();

Route::post('/login', [
    'uses' => 'SigninController@signin',
    'as' => 'auth.signin'
]);