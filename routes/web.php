<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PetController as PetController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/pets', [PetController::class, 'index'])->name('pets.index');
Route::post('/pets', [PetController::class, 'store'])->name('pets.store');
Route::get('/pets/{id}/edit', [PetController::class, 'edit'])->name('pets.edit');
Route::put('/pets/{id}/update', [PetController::class, 'update'])->name('pets.update');
Route::delete('/pets/{id}/delete', [PetController::class, 'destroy'])->name('pets.destroy');

Route::get('/', function () {
    return view('welcome');
});
