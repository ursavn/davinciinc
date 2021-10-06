<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\TemplateController;
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
    return view('home');
});

Route::get('/template/{id}', [TemplateController::class, 'show']);

Route::get('admin/login', [LoginController::class, 'getLogin'])->name('getLogin');
Route::post('admin/login', [LoginController::class, 'postLogin'])->name('postLogin');
Route::get('admin/logout', [LoginController::class, 'getLogout']);

