<?php

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/moduloInventario', 'HomeController@moduloInventario')->name('moduloInventario');

Route::get('/moduloAdministracion', 'HomeController@moduloAdministracion')->name('moduloAdministracion');

Route::get('/moduloServicios', 'HomeController@moduloServicios')->name('moduloServicios');

Route::get('/notFound', 'HomeController@notFound')->name('notFound');

