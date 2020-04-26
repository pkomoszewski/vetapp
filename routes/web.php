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

use App\Http\Controllers\OrderController;

Route::get('/', function () {
    return view('pages.index');
});

Auth::routes();

route::get('/registervet','Auth\RegisterController@showRegistrationVetForm' )->name('registervet');
route::post('registervet','Auth\RegisterController@registerVet')->name('registervetpost');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/allConcert', 'ConcertController@index');
Route::get('/profile/{user}/edit', 'ProfilesController@edit')->name('profile.edit');
Route::get('/showorder/{id}','OrderController@index')->name('showOrders');
Route::get('/order/{id}/{user}','OrderController@makeOrder')->name('makeOrder.edit');
Route::get('/profile/{user}', 'ProfilesController@index')->name('profile.show');
Route::get('/articles', 'HomeController@articles')->name('articles.show');

Route::patch('/profile/{user}', 'ProfilesController@update')->name('profile.update');

Route::get('/{animal_id}/delete', 'AnimalController@delete');


Route::get('/searchCities', 'FrontendController@searchCities');