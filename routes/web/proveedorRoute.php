<?php
Route::resource('ajaxProveedor', 'proveedorController');

Route::get('agregaProveedor', 'proveedorController@agregaProveedor')->name('agregaProveedor');

Route::get('detalleProveedor/{id}', 'proveedorController@obtenerDetalleProveedor')->name('detalleProveedor');

Route::get('obtenerArticuloCtrl/{id}/{control}', 'proveedorController@obtenerArticuloCtrl')->name('obtenerArticuloCtrl');

Route::get('eliminarDireccion/{id}', 'proveedorController@eliminarDireccion')->name('eliminarDireccion');

Route::get('eliminarProveedor/{id}', 'proveedorController@eliminarProveedor')->name('eliminarProveedor');