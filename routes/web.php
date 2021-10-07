<?php

use App\Http\Controllers\TemplateController;
use App\Http\Controllers\AuthController;
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
    return view('pages.users.home');
})->name('home');

Route::get('/select-template', [TemplateController::class, 'getAllTemplates'])->name('select-template');
Route::get('/select-template/{id}', [TemplateController::class, 'showTemplate'])->name('show-template');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::name('auth.')->group(function () {
        Route::get('login', [AuthController::class, 'getLogin'])->name('get-login');
        Route::post('login', [AuthController::class, 'postLogin'])->name('post-login');
        Route::get('logout', [AuthController::class, 'getLogout']);

        Route::get('register', [AuthController::class, 'getRegister'])->name('get-register');
        Route::post('register', [AuthController::class, 'postRegister'])->name('post-register');
    });
});
