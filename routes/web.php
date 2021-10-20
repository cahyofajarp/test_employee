<?php

use Illuminate\Support\Facades\Auth;
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
    return view('auth.login');
});


Auth::routes();

Route::get('/test-sql',function() {
    // $data = Transaksitm::
});

Route::any('/register', [App\Http\Controllers\HomeController::class, 'index']);

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::middleware('auth')->group(static function () {
    Route::get('/dashboard',[\App\Http\Controllers\HomeController::class,'index'])->name('dashboard');
    Route::resource('employee', App\Http\Controllers\EmployeeController::class);
});
