<?php

Route::get('/verInventario', 'articulosController@verInventario')->name('verInventario');
Route::get('/detalleArticulo', 'articulosController@detalleArticulo')->name('detalleArticulo');


//URL ajax
Route::get('agregarArticulo','articulosController@agregarArticulo')->name('agregarArticulo');
Route::get('obtenerArticulo/{clave}','articulosController@obtenerArticulo')->name('obtenerArticulo');
Route::get('obtenerArticuloCtrl/{id}/{control}','articulosController@obtenerArticuloCtrl')->name('obtenerArticuloCtrl');

//CURD ajax
Route::resource('ajaxCreaArticulo','articulosController');
