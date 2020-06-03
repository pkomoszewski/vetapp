<?php

use App\Http\Controllers\OrderController;

Route::get('/', 'FrontendController@index')->name('home');

Route::get('/calendar', function () {
    return view('pages.calendar');
});
Auth::routes();

route::get('/registervet','Auth\RegisterController@showRegistrationVetForm' )->name('registervet');
route::post('registervet','Auth\RegisterController@registerVet')->name('registervetpost');
Route::get('register-step2', 'Auth\RegisterStep2Controller@showForm')->name('register-step2');
Route::post('register-step2', 'Auth\RegisterStep2Controller@postForm')
  ->name('register-step2post');


Route::match(['GET','POST'],trans('routes.profile').'/{user}','FrontendController@profileEdit')->name('profile');



///////////////////////////////////////////////////////////////////////////////
//do usuniecia
Route::post(trans('save.vetprofile').'/{id}','ProfilesController@edit')->name('profile.save');


//Routing do profilu uzytkownika zaleznie czy jest Onwerem czy weterynarzem
Route::get('/profile/{user}', 'FrontendController@indexProfile')->name('profile.index');
Route::post('deleteSelf','BackendController@deleteSelf')->name('deleteSelf');
// Edycja "Profilu przez uzytkownika"



//podpowiedz dla wyszukiwania miast
Route::get('/searchCities', 'FrontendController@searchCities');

Route::get(trans('search'),'FrontendController@search')->name('Search');


/////////
Route::post(trans('newletter'),'FrontendController@addNewsletter')->name('addNewsletter');
//polubienia uzytkowników
Route::get('/like/{like_id}/{type}', 'FrontendController@like')->name('like'); 
Route::get('/unlike/{like_id}/{type}', 'FrontendController@unlike')->name('unlike');

///////////////////rezerwacje widoki rezerwacji
////////u uzytkownika
Route::get('/reservations/{owner_id}', 'FrontendController@calendarVisitToUser')->name('calendarVisitToUser');
////////u weterynarza
Route::get('/calendarvisits/{user_id}', 'FrontendController@siteCalendarvisit')->name('calendarvisits');
Route::get('/confirmvisits'.'/{reservation_id}', 'FrontendController@confirmReservationVet')->name('confirmReservationVet');
Route::get('/cancelvisits'.'/{reservation_id}', 'FrontendController@cancelReservationVet')->name('cancelReservationVet');

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

Route::post(trans('addNewAnimal').'/{id}','BackendController@NewAnimal')->name('addNewAnimal');
Route::get('/{animal_id}/delete', 'AnimalController@delete');

// dodawanie komentarz
Route::post('/addComment/{commentable_id}/{type}', 'FrontendController@addComment')->name('addComment'); 
Auth::routes();



//Panel administratora Drugi moduł

Route::middleware(['auth','CheckAdmin'])->group(function () {

  Route::get('/admin/pas', 'BackendController@showAdminPanel')->name('indexPAS');
  Route::get('/admin/visits', 'BackendController@showAllReservations')->name('indexVisits');
  Route::post('/admin/visits/delete/','BackendController@deleteReservation')->name('deleteVisit');
  Route::post('delete','BackendController@deleteUser')->name('deleteUser');
  Route::get('/admin/ban/{id}','BackendController@banUser')->name('banUser');
  Route::get('/admin/vet/all','BackendController@showAllVet')->name('allVet');
  Route::get('/admin/article/all','BackendController@getListArticles')->name('allArticle');
  Route::post('/admin/article/delete','BackendController@deleteArticle')->name('deleteArticle');

  Route::get('/admin/static/','BackendController@showSiteStatic')->name('staticSite');
    
  Route::get('/admin/article/edit/{id}','BackendController@showEditArticle')->name('showEditArticle');
  Route::post('/admin/article/edit/{id}','BackendController@saveEditArticle')->name('saveEditArticle');

  Route::match(['GET','POST'],'/addArticle','BackendController@newArticle')->name('newArticle');
  

 

});
// Route dla artykułow
Route::get('/articles', 'frontendController@showListArticles')->name('ShowListArticles');

Route::middleware(['auth'])->group(function () {
  Route::get('/showarticle/{id}', 'BackendController@showArticle')->name('showArticle');
});
Route::middleware(['auth'])->group(function () {
  Route::get('/history/{id}', 'BackendController@showHistoryTreatmeantAnimal')->name('showHistoryTreatmeantAnimal');

});

Route::middleware(['auth'])->group(function () {
  Route::get('/successsave', 'BackendController@viewSuccessSave')->name('viewSucessSave');

  Route::get('/historyadd/{id}', 'BackendController@showformAddHistoryTreatmeantAnimal')->name('showformAddHistoryTreatmeantAnimal');
  Route::post('/addHistory/{id}','BackendController@NewHistoryTreatmeantAnimal')->name('addNewHistoryTreatmeantAnimal');
});

