<?php

use Illuminate\Support\Facades\Route;
// Route::post('/register', 'Api\AuthController@register');
//Route::post('/login', 'Api\V1\AuthController@login');



Route::group([
    'prefix' => 'v1/auth',
    'namespace' => 'Api\V1',
], function ($router) {
    Route::post('/login', 'AuthController@login');
});

Route::group([
    'prefix' => 'v1',
    'namespace' => 'Api\V1',
    'middleware' => 'api_mobile',
], function ($router) {
    Route::get('/privateNews', 'PrivateNewsController@index');
    Route::get('/procedure', 'ServiceController@serviceProcedure');
});
Route::group([
    'prefix' => 'v1',
    'namespace' => 'Api\V1',
], function ($router) {
    Route::get('/publicNews', 'PublicNewsController@index');
    Route::get('/article', 'HelpCaseController@HelpList');
    Route::get('/case', 'HelpCaseController@CaseList');
    Route::get('/description', 'ServiceController@serviceDescription');
    Route::get('/nationalPartner', 'NationalPartnerController@index');
    Route::get('/region', 'RegionController@index');
    Route::get('/region/{regionId}/uniteRegionals', 'RegionController@uniteRegionals');
    Route::get('/unitRegion', 'UnitRegionalController@index');
});