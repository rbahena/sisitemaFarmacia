<?php

Route::get('/verInventario', 'articulosController@verInventario')->name('verInventario');

Route::get('/detalleArticulo', 'articulosController@detalleArticulo')->name('detalleArticulo');

//URL ajax
Route::get('agregarArticulo','articulosController@agregarArticulo')->name('agregarArticulo');

Route::get('obtenerArticulo/{clave}','articulosController@obtenerArticulo')->name('obtenerArticulo');

Route::resource('ajaxCreaArticulo','articulosController');
