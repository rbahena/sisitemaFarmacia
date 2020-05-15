<?php
Route::resource('ajaxEmpleado','empleadoController');

Route::get('/agregarEmpleado', 'EmpleadoController@agregarEmpleado')->name('agregarEmpleado');