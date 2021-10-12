<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\TemplateController as AdminTemplateController;
use App\Http\Controllers\Admin\UserController;
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
    return view('pages.users.home');
})->name('home');

Route::get('/templates', [TemplateController::class, 'getAllTemplates'])->name('select-template');
Route::get('/templates/{id}', [TemplateController::class, 'showTemplate'])->name('show-template');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::name('auth.')->group(function () {
        Route::get('login', [AuthController::class, 'getLogin'])->name('get-login');
        Route::post('login', [AuthController::class, 'postLogin'])->name('post-login');
        Route::get('logout', [AuthController::class, 'getLogout'])->name('get-logout');

        Route::get('register', [AuthController::class, 'getRegister'])->name('get-register');
        Route::post('register', [AuthController::class, 'postRegister'])->name('post-register');

        Route::post('reset-password', [AuthController::class, 'resetPassword'])->name('reset-password');
    });

    Route::middleware('auth')->group(function () {
        Route::resource('users', UserController::class);
        Route::get('any-data', [UserController::class, 'anyData'])->name('any-data');

        Route::resource('categories', CategoryController::class);
        Route::get('category-any-data', [CategoryController::class, 'anyData'])->name('categories.any-data');

        Route::resource('templates', AdminTemplateController::class);
        Route::get('template-any-data', [AdminTemplateController::class, 'anyData'])->name('templates.any-data');
    });
});
