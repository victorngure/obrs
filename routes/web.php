<?php

use Illuminate\Support\Facades\Route;

Auth::routes();

Route::resource('task','TasksController');

Route::get('task/delete/{id}', 'TasksController@destroy');

Route::get('task/edit/{id}', 'TasksController@edit');

Route::get('task/{id}', 'TasksController@show');

Route::resource('comment','TaskCommentsController');

Route::group( ['middleware' => 'auth' ], function()
{

    Route::resource('/','OBRS\TripController@create');

    Route::resource('trip','OBRS\TripController');

    Route::resource('booking','OBRS\BookingController');

    Route::get('student/edit/{id}', 'StudentsController@edit');

    Route::put('/{id}', 'StudentsController@update');

    Route::get('student/delete/{id}', 'StudentsController@destroy');  

    Route::post('payment/initiate', 'OBRS\BookingController@initiateTransaction');  

    Route::get('trip/bookings/{id}', 'OBRS\TripController@getBookings');  
});

Route::get('/logout', 'Auth\LoginController@logout');

Route::get('/home', 'HomeController@index')->name('home');

