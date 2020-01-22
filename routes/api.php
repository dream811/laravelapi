<?php

use Illuminate\Http\Request;

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

Route::post('/v1/GfsUserRegister', 'Api\v1\PassportAuthTestingController@register');
Route::post('/v1/login', 'Api\v1\PassportAuthTestingController@login');
//Route::group(['middleware' => ['auth:api', 'client']], function(){    

Route::get('/v1/getModules', 'Api\v1\ManageModuleController@show');

// Batch Process Api
Route::get('/v1/getBatchDetails', 'Api\v1\BatchProcessController@showDetails');

Route::group(['middleware' => 'auth:api',
    'prefix' => 'v1'
], function(){            
    Route::get('GfsGetUserDetail', 'Api\v1\PassportAuthTestingController@getUserDetail');

    //[ADMINISTRATION / USERMODULE
    Route::get('getModules/{id}', 'Api\v1\ManageModuleController@show');
    Route::post('saveModules',    'Api\v1\ManageModuleController@create');
    ///*** Aleks(Producer Module) ***///
    /*
        Agency
    */
    // Batch Process Api
    Route::apiResource('/agency', 'Api\v1\AgencyController');
    Route::get('/agency/{id}/detail', 'Api\v1\AgencyController@showDetail');
    Route::post('/agency/{id}/detail', 'Api\v1\AgencyController@storeDetail');

    ///*** end ***///

	Route::post('saveAccountType', 'Api\v1\ManageAccountingController@create');
	Route::get('getAccountsType', 'Api\v1\ManageAccountingController@show');

});

Route::apiResource('/v1/policies', 'Api\v1\PolicyController');
Route::apiResource('/v1/claims', 'Api\v1\ClaimController');
Route::apiResource('/v1/claim_types', 'Api\ClaimTypeController');
Route::apiResource('/v1/products', 'Api\v1\ProductController');
Route::apiResource('/v1/person', 'Api\v1\PersonController');

