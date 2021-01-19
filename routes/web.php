<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Redirect('/home');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\RulesController::class, 'index'])->name('home');
Route::get('rule', [App\Http\Controllers\RulesController::class,'index']);
Route::post('rule', [App\Http\Controllers\RulesController::class,'store']);
Route::get('/task.js', [App\Http\Controllers\FilesController::class,'index']);