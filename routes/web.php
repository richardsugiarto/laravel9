<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LocalizationController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\ArticleController;
use Illuminate\Support\Facades\App;
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
    return view('myhome');
})->middleware('web');
//Auth::routes();
Route::view('/home', 'home')->middleware('auth','verified');

Route::get("locale/{lang}",[LocalizationController::class,'setlang']);

Route::get('two-fa',function () {
    return view('two-fa');
})->middleware('auth','verified');

Route::controller(GoogleController::class)->group(function(){
    Route::get('auth/google', 'redirectToGoogle')->name('auth.google');
    Route::get('auth/google/callback', 'handleGoogleCallback');
});

Route::get('/post_article', function () {
    return view('post_article');
})->middleware('auth','verified');

Route::get('/all_article',[ArticleController::class,'showall'])->middleware('auth','verified');

Route::get('/my_article',[ArticleController::class,'showmyarticle'])->middleware('auth','verified');

Route::post('/post_article_action',[ArticleController::class,'store'])->middleware('auth','verified');
Route::get('/update_article/{id}',[ArticleController::class,'update_form'])->middleware('auth','verified');
Route::put('/update_article_action',[ArticleController::class,'update_action'])->middleware('auth','verified');
Route::delete('/delete_article/{id}',[ArticleController::class,'destroy'])->middleware('auth','verified');
