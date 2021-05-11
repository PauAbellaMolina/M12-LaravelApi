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
Route::get('JVyCcKg6sCkkFaaBbapK8uEcbuxz8LMAmpESzKhV/commerces/{id}', 'CommerceController@getCommerceById'); //Maybe not needed
Route::get('JVyCcKg6sCkkFaaBbapK8uEcbuxz8LMAmpESzKhV/commerces/category/{commerce_category}', 'CommerceController@getCommerceByCategory');

Route::get('JVyCcKg6sCkkFaaBbapK8uEcbuxz8LMAmpESzKhV/categories', 'CategoriesController@index');
Route::get('JVyCcKg6sCkkFaaBbapK8uEcbuxz8LMAmpESzKhV/categories/{id}', 'CategoriesController@getCategorieById');

Route::get('JVyCcKg6sCkkFaaBbapK8uEcbuxz8LMAmpESzKhV/levels', 'LevelsController@index');
Route::get('JVyCcKg6sCkkFaaBbapK8uEcbuxz8LMAmpESzKhV/levels/{points}', 'LevelsController@getLevelByPoints');

Route::get('JVyCcKg6sCkkFaaBbapK8uEcbuxz8LMAmpESzKhV/users', 'UsersController@index');
Route::get('JVyCcKg6sCkkFaaBbapK8uEcbuxz8LMAmpESzKhV/users/{id}', 'UsersController@getUserById');

Route::get('JVyCcKg6sCkkFaaBbapK8uEcbuxz8LMAmpESzKhV/points', 'PointsController@index');
Route::get('JVyCcKg6sCkkFaaBbapK8uEcbuxz8LMAmpESzKhV/points/{id_user}/{id_commerce}', 'PointsController@getPointsById');
Route::post('JVyCcKg6sCkkFaaBbapK8uEcbuxz8LMAmpESzKhV/points/{id_user}/{id_commerce}/{points}', 'PointsController@addPointsById');

Route::get('JVyCcKg6sCkkFaaBbapK8uEcbuxz8LMAmpESzKhV/transactions', 'TransactionsHistoryController@index');
Route::get('JVyCcKg6sCkkFaaBbapK8uEcbuxz8LMAmpESzKhV/transactions/commerce/{id_commerce}', 'TransactionsHistoryController@getTrasnactionsByCommerce');
Route::get('JVyCcKg6sCkkFaaBbapK8uEcbuxz8LMAmpESzKhV/transactions/user/{id_user}', 'TransactionsHistoryController@getTrasnactionsByUser');

Route::get('JVyCcKg6sCkkFaaBbapK8uEcbuxz8LMAmpESzKhV/recompenses/{id_commerce}', 'RecompensesController@getRecompensesByCommerce');
