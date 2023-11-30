<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DrinkController;
use App\Http\Controllers\AdminController;

/**
 * ROTA PARA A PÁGINA PRINCIPAL
 */
Route::get('/', [DrinkController::class, 'index']);


/**
 * ROTAS PARA OS DRINKS
 */
Route::get('/drink/{id}', [DrinkController::class, 'drink']);

Route::get('/drinks/{id}', [DrinkController::class, 'drinksByCategory']);

Route::post('/drink', [DrinkController::class, 'store'])->middleware('auth');

Route::put('/drink/{id}', [DrinkController::class, 'update'])->middleware('auth');

Route::delete('/drink/{id}', [DrinkController::class, 'destroy'])->middleware('auth');


/**
 * ROTAS PARA OS ACESSOS ADMINISTRADOR
 */
Route::get('/login', [AdminController::class, 'login'])->name('login');

Route::get('/admin', [AdminController::class, 'index'])->middleware('auth');

Route::get('/register', function(){
  return redirect('/login');
});


