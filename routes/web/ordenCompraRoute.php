<?php
Route::get('ordenCompra', 'ordenCompraController@ordenCompra')->name('ordenCompra');

Route::resource('ajaxOrdenCompra', 'ordenCompraController');
Route::get('obtenerDatosProveedor/{id}', 'ordenCompraController@obtenerDatosProveedor')->name('obtenerDatosProveedor');
Route::get('obtenerDatosProducto/{id}', 'ordenCompraController@obtenerDatosProducto')->name('obtenerDatosProducto');

Route::post('obtenerAlmacenes', 'ordenCompraController@obtenerAlmacenes')->name('obtenerAlmacenes');
Route::post('obtenerProductos', 'ordenCompraController@obtenerProductos')->name('obtenerProductos');

Route::post('creaOrdenCompra', 'ordenCompraController@creaOrdenCompra')->name('creaOrdenCompra');
