<?php

use App\Http\Controllers\TemplateController;
use App\Http\Controllers\LoginController;
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
})->name('home');

Route::get('/select-template', [TemplateController::class, 'getAllTemplates'])->name('select-template');
Route::get('/select-template/{id}', [TemplateController::class, 'showTemplate'])->name('show-template');

Route::get('admin/login', [LoginController::class, 'getLogin'])->name('getLogin');
Route::post('admin/login', [LoginController::class, 'postLogin'])->name('postLogin');
Route::get('admin/logout', [LoginController::class, 'getLogout']);
