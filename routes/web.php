<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CategoryController;
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
})->name('home');

Route::get('/select-template', [TemplateController::class, 'getAllTemplates'])->name('select-template');
Route::get('/select-template/{id}', [TemplateController::class, 'showTemplate'])->name('show-template');

Route::get('admin/login', [AuthController::class, 'getLogin'])->name('get-login');
Route::post('admin/login', [AuthController::class, 'postLogin'])->name('post-login');
Route::get('admin/logout', [AuthController::class, 'getLogout']);

Route::get('admin/register', [AuthController::class, 'getRegister'])->name('get-register');
Route::post('admin/register', [AuthController::class, 'postRegister'])->name('post-register');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::prefix('categories')->name('categories.')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('index');
        Route::get('any-data', [CategoryController::class, 'anyData'])->name('any-data');
        Route::delete('/{id}', [CategoryController::class, 'destroy'])->name('destroy');
    });
});
