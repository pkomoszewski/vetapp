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

Route::get('/calendar', function () {
    return view('pages.calendar');
});
Auth::routes();

route::get('/registervet','Auth\RegisterController@showRegistrationVetForm' )->name('registervet');
route::post('registervet','Auth\RegisterController@registerVet')->name('registervetpost');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/allConcert', 'ConcertController@index');


// Route::get('/profile/{user}/edit', 'ProfilesController@edit')->name('profile.edit');

Route::post(trans('save.vetprofile').'/{id}','ProfilesController@edit')->name('profile.save');





//Routing do profilu uzytkownika zaleznie czy jest Onwerem czy weterynarzem
Route::get('/profile/{user}', 'FrontendController@index')->name('profile.index');
// Edycja "Profilu przez uzytkownika"
Route::match(['GET','POST'],trans('routes.profile').'/{user}','FrontendController@profileEdit')->name('profile');



// do wyrzucenia 
Route::get('/showorder/{id}','OrderController@index')->name('showOrders');
Route::get('/order/{id}/{user}','OrderController@makeOrder')->name('makeOrder.edit');




// Route dla artykułow
Route::get('/articles', 'HomeController@articles')->name('articles.show');


//podpowiedz dla wyszukiwania miast
Route::get('/searchCities', 'FrontendController@searchCities');

Route::post(trans('search'),'FrontendController@vetsearch')->name('vetSearch');


//polubienia uzytkowników
Route::get('/like/{like_id}/{type}', 'FrontendController@like')->name('like'); 
Route::get('/unlike/{like_id}/{type}', 'FrontendController@unlike')->name('unlike');

///////////////////rezerwacje widoki rezerwacji u uzytkownika
////////u uzytkownika
Route::get('/reservations/{user_id}/', 'FrontendController@siteReservation')->name('reservations');
////////u weterynarza
Route::get('/calendarvisits/{user_id}', 'FrontendController@siteCalendarvisit')->name('calendarvisits');


///////////////////
Route::get('/reservationscalnedar/{vet_id}/{user_id}/', 'FrontendController@siteReservationCalendar')->name('reservationscalendar');
Route::get(trans('ViewformReservation').'/{date}'.'/{ts}'.'/{vet_id}','FrontendController@ViewformReservation')->name('ViewformReservation');
Route::post(trans('confirmReservation').'/{vet_id}','FrontendController@confirmReservation')->name('confirmReservation');

// dla weterynarza
Route::get(trans('vet').'/{id}','FrontendController@sitevet')->name('sitevet'); 
//dla kliniki
Route::get(trans('clinic').'/{id}','FrontendController@siteclinic')->name('siteclinic'); 

//Zwierzaki

Route::get('/addAnimal','FrontendController@viewAddFormAnimal')->name('addAnimal');// Zmienic nazwe route

route::post(trans('addNewAnimal').'/{id}','BackendController@NewAnimal')->name('addNewAnimal');
Route::get('/{animal_id}/delete', 'AnimalController@delete');

// dodawanie komentarz
Route::post('/addComment/{commentable_id}/{type}', 'FrontendController@addComment')->name('addComment'); 