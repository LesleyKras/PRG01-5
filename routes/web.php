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

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/advertisements', [
    'uses' => 'AdvertisementController@getIndex',
    'as' => 'advertisements.index'
]);

Route::get('/advertisements/{id}', [
    'uses' => 'AdvertisementController@getAdvertisement'
])->name('advertisements.post');

Route::group(['prefix' => 'profile'], function() {
    Route::get('', function(){
        return view('profile.index');
    })->name('profile.index');

    Route::get('/create', function () {
        return view('profile.create');
    })->name('profile.create');

    Route::post('/create', [
        'uses' => 'AdvertisementController@createAdvertisement',
        'as' => 'advertisements.index'
    ])->name('profile.create');

    Route::get('/edit/{id}', [
        'uses' => 'AdvertisementController@getAdvertisementEdit',
        'as' => 'profile.edit'
    ]);

    Route::get('/delete/{id}', [
        'uses' => 'AdvertisementController@getAdvertisementDelete',
        'as' => 'profile.delete'
    ]);

    Route::post('/edit', [
        'uses' => 'AdvertisementController@updateAdvertisement',
        'as' => 'profile.update'
    ]);
});

Route::get('/categories', function () {
    return view('categories.index');
})->name('categories.index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
