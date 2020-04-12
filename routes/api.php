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

Route::post('/help', 'HelpController@help');
Route::post('/offer/{help_id}', 'OfferController@offer');

Route::get('/marks/{latitude}/{longitude}/{zoom}/', 'MapController@getMarks');
Route::get('/categories', 'HelpController@getCategories');
