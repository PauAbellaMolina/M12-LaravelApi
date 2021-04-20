<?php

use Illuminate\Http\Request;
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
    return $request->user();
});

Route::get('JVyCcKg6sCkkFaaBbapK8uEcbuxz8LMAmpESzKhV/commerces', 'CommerceController@index');
Route::get('JVyCcKg6sCkkFaaBbapK8uEcbuxz8LMAmpESzKhV/commerces/{id}', 'CommerceController@getCommerceById');

Route::get('JVyCcKg6sCkkFaaBbapK8uEcbuxz8LMAmpESzKhV/categories', 'CategoriesController@index');
Route::get('JVyCcKg6sCkkFaaBbapK8uEcbuxz8LMAmpESzKhV/categories/{id}', 'CategoriesController@getCategorieById');

Route::get('JVyCcKg6sCkkFaaBbapK8uEcbuxz8LMAmpESzKhV/levels', 'LevelsController@index');
Route::get('JVyCcKg6sCkkFaaBbapK8uEcbuxz8LMAmpESzKhV/levels/{id}', 'LevelsController@getLevelById');

Route::get('JVyCcKg6sCkkFaaBbapK8uEcbuxz8LMAmpESzKhV/users', 'UsersController@index');
Route::get('JVyCcKg6sCkkFaaBbapK8uEcbuxz8LMAmpESzKhV/users/{id}', 'UsersController@getUserById');

Route::get('JVyCcKg6sCkkFaaBbapK8uEcbuxz8LMAmpESzKhV/points', 'PointsController@index');
Route::get('JVyCcKg6sCkkFaaBbapK8uEcbuxz8LMAmpESzKhV/points/{id_user}/{id_commerce}', 'PointsController@getPointsById');
