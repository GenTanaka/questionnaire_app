<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
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
Auth::routes();

Route::get('/', function () {
    return view('home');
});

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/questionnaire/{id}', [HomeController::class, 'questionnaire'])->name('questionnaire');

Route::get('/make', [HomeController::class, 'make'])->name('make');
Route::post('/makedQuestionnaire', [HomeController::class, 'makedQuestionnaire'])->name('makedQuestionnaire');

Route::get('/answer/{id}', [HomeController::class, 'answer'])->name('answer');
Route::post('/saveAnswer', [HomeController::class, 'saveAnswer'])->name('saveAnswer');
