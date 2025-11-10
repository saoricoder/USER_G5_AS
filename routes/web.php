<?php

use Illuminate\Support\Facades\Route;
// Pantalla de Login (Citas Médicas)
Route::get('/login', function () {
    return view('login');
})->name('login');

// Utilidad: guardar token en localStorage desde query param o formulario
Route::get('/set-token', function () {
    return view('set-token');
})->name('set-token');

// Pantalla principal de Usuarios (CRUD en una sola vista)
Route::get('/usuarios', function () {
    return view('usuarios');
})->name('usuarios');

// Rutas de UI separadas que reutilizan la misma vista
Route::get('/usuarios/crear', function () {
    return view('usuarios');
})->name('usuarios.crear');

Route::get('/usuarios/{id}', function ($id) {
    return view('usuarios');
})->whereNumber('id')->name('usuarios.ver');

Route::get('/usuarios/{id}/editar', function ($id) {
    return view('usuarios');
})->whereNumber('id')->name('usuarios.editar');
