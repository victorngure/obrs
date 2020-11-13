<?php

use Illuminate\Support\Facades\Route;

Auth::routes(['verify' => true]);

Route::resource('task','TasksController');

Route::get('task/delete/{id}', 'TasksController@destroy');

Route::get('task/edit/{id}', 'TasksController@edit');

Route::get('task/{id}', 'TasksController@show');

Route::resource('comment','TaskCommentsController');

Route::group( ['middleware' => 'verified'], function()
{
    Route::get('/home', 'HomeController@index')->name('home');

    Route::resource('/','OBRS\TripController');

    Route::resource('trip','OBRS\TripController');

    Route::resource('booking','OBRS\BookingController');

    Route::resource('bus','OBRS\BusController');

    Route::get('/bus/schedule/{id}', 'OBRS\BusController@schedule');

    Route::get('student/edit/{id}', 'StudentsController@edit');

    Route::put('/{id}', 'StudentsController@update');

    Route::get('student/delete/{id}', 'StudentsController@destroy');  

    Route::post('payment/initiate', 'OBRS\BookingController@initiateTransaction');  

    Route::get('trip/bookings/{id}', 'OBRS\TripController@getBookings'); 
    
    Route::get('/users', 'OBRS\AdminController@index'); 

    Route::get('/user/edit/{id}', 'OBRS\AdminController@edit');    

    Route::put('/user/{id}', 'OBRS\AdminController@update'); 

    Route::get('/user/tickets', 'OBRS\BookingController@myTickets'); 
});

Route::get('/logout', 'Auth\LoginController@logout');