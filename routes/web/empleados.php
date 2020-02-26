<?php

Route::get('/inventario', 'inventarioController@verInventario')->name('inventario');

Route::post('/agregar-articulo',array(
    'as' => 'agregarArticulo',
    'uses' => 'inventarioController@agregarArticulo'
));

