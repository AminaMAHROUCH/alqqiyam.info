<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:api']], function () {
    // Permissions
    Route::apiResource('permissions', 'PermissionsApiController');

    // Roles
    Route::apiResource('roles', 'RolesApiController');

    // Users
    Route::apiResource('users', 'UsersApiController');

    // Comments
    Route::apiResource('comments', 'CommentApiController');

    // Categories
    Route::post('categories/media', 'CategoryApiController@storeMedia')->name('categories.storeMedia');
    Route::apiResource('categories', 'CategoryApiController');

    // Posts
    Route::post('posts/media', 'PostApiController@storeMedia')->name('posts.storeMedia');
    Route::apiResource('posts', 'PostApiController');

    // Brands
    Route::post('brands/media', 'BrandApiController@storeMedia')->name('brands.storeMedia');
    Route::apiResource('brands', 'BrandApiController');

    // Products
    Route::post('products/media', 'ProductApiController@storeMedia')->name('products.storeMedia');
    Route::apiResource('products', 'ProductApiController');

    // Orders
    Route::apiResource('orders', 'OrderApiController');

    // Trainings
    Route::post('trainings/media', 'TrainingApiController@storeMedia')->name('trainings.storeMedia');
    Route::apiResource('trainings', 'TrainingApiController');

    // Members
    Route::post('members/media', 'MemberApiController@storeMedia')->name('members.storeMedia');
    Route::apiResource('members', 'MemberApiController');

    // Articles
    Route::post('articles/media', 'ArticleApiController@storeMedia')->name('articles.storeMedia');
    Route::apiResource('articles', 'ArticleApiController');

    // Reviews
    Route::apiResource('reviews', 'ReviewApiController');
});