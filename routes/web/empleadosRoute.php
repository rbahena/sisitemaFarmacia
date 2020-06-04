<?php
Route::resource('ajaxEmpleado', 'empleadoController');

Route::get('agregaEmpleado', 'empleadoController@agregaEmpleado')->name('agregaEmpleado');

Route::get('detalleempleado/{id}', 'empleadoController@obtenerDetalleempleado')->name('detalleempleado');

Route::get('obtenerEmpleadoCtrl/{id}/{control}', 'empleadoController@obtenerEmpleadoCtrl')->name('obtenerEmpleadoCtrl');

Route::get('eliminarDireccion/{id}', 'empleadoController@eliminarDireccion')->name('eliminarDireccion');

Route::get('eliminarEmpleado/{id}', 'empleadoController@eliminarEmpleado')->name('eliminarEmpleado');
