<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;

Route::get('/productos', [ProductoController::class, 'index']);
Route::post('/productos/crearProducto', [ProductoController::class, 'crearProducto']);
Route::get('/productos/editarProducto{id?}', [ProductoController::class, 'editarProducto']);
Route::get('/productos/eliminarProducto{id?}', [ProductoController::class, 'eliminarProducto']);
Route::post('/productos/actualizarProducto', [ProductoController::class, 'actualizarProducto']);



