<?php

use App\Http\Controllers\ChauffeurController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VehiculeController;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Route as RoutingRoute;
use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return Auth::user();
});

Route::get('users', function(){
    return User::all();
});

Route::group(['namespace'=>'Api\Auth'], function(){
    //authentification
    Route::post('/login', 'AuthenticationController@login');
    Route::post('/logout', 'AuthenticationController@logout')->middleware('auth:api');
    Route::post('/register', 'RegisterController@register');
    Route::post('/forgot', 'ForgotPasswordController@forgot');
    Route::post('/reset', 'ForgotPasswordController@reset');
    //chauffeur
    Route::get('show',[ChauffeurController::class,'show']);
    Route::post('add',[chauffeurController::class,'add']);
    Route::delete('delete/{id}',[chauffeurController::class,'delete']);
    Route::get('index',[UserController::class,'index']);
    Route::get('getChauffeur/{id}',[chauffeurController::class,'getChauffById']);
    Route::post('UpdateChauffeur/{id}',[chauffeurController::class,'update']);
   

    //vehicule 
    Route::post('addvehicule',[VehiculeController::class,'add']);
    Route::delete('deletevehicule/{id}',[VehiculeController::class,'delete']);
    Route::get('getvehicule/{id}',[VehiculeController::class,'getvehiculeById']);
    Route::get('selectall',[VehiculeController::class,'selectall']);
    Route::post('updatevehicule/{id}',[VehiculeController::class,'update']);


});

