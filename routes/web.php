<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Livewire\Utilisateur;

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
    return view('welcome');
});
//deconnexion de l'itulisateur qui fait apppel a la Controller User.
Route::get('/deconnexion',[UserController::class,'log_out'])->name('user_logout');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group([
    "middleware"=>['auth','auth.admin'],
    'as'=>"admin."
],function(){
    Route::group([
      "prefix"=>"management",
      "as" =>"management."
    ],function(){
    Route::get('/listes_utilisateur',Utilisateur::class)->name('shows_utilisateurs');
   
   });
});