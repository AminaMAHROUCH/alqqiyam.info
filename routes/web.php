<?php

Route::redirect('/', '/login');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Auth::routes(['register' => false]);
// Admin

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Private News
    Route::delete('private-news/destroy', 'PrivateNewsController@massDestroy')->name('private-news.massDestroy');
    Route::post('private-news/media', 'PrivateNewsController@storeMedia')->name('private-news.storeMedia');
    Route::post('private-news/ckmedia', 'PrivateNewsController@storeCKEditorImages')->name('private-news.storeCKEditorImages');
    Route::resource('private-news', 'PrivateNewsController');

    // Public News
    Route::delete('public-news/destroy', 'PublicNewsController@massDestroy')->name('public-news.massDestroy');
    Route::post('public-news/media', 'PublicNewsController@storeMedia')->name('public-news.storeMedia');
    Route::post('public-news/ckmedia', 'PublicNewsController@storeCKEditorImages')->name('public-news.storeCKEditorImages');
    Route::resource('public-news', 'PublicNewsController');

    // Regions
    Route::delete('regions/destroy', 'RegionController@massDestroy')->name('regions.massDestroy');
    Route::resource('regions', 'RegionController');

    // Provinces
    Route::delete('provinces/destroy', 'ProvinceController@massDestroy')->name('provinces.massDestroy');
    Route::resource('provinces', 'ProvinceController');

    // Services
    Route::delete('services/destroy', 'ServiceController@massDestroy')->name('services.massDestroy');
    Route::post('services/media', 'ServiceController@storeMedia')->name('services.storeMedia');
    Route::post('services/ckmedia', 'ServiceController@storeCKEditorImages')->name('services.storeCKEditorImages');
    Route::resource('services', 'ServiceController');

    // Help Cases
    Route::delete('help-cases/destroy', 'HelpCaseController@massDestroy')->name('help-cases.massDestroy');
    Route::post('help-cases/media', 'HelpCaseController@storeMedia')->name('help-cases.storeMedia');
    Route::post('help-cases/ckmedia', 'HelpCaseController@storeCKEditorImages')->name('help-cases.storeCKEditorImages');
    Route::resource('help-cases', 'HelpCaseController');

    // Links
    Route::delete('links/destroy', 'LinkController@massDestroy')->name('links.massDestroy');
    Route::resource('links', 'LinkController');

    // Province Partners
    Route::delete('province-partners/destroy', 'ProvincePartnerController@massDestroy')->name('province-partners.massDestroy');
    Route::post('province-partners/media', 'ProvincePartnerController@storeMedia')->name('province-partners.storeMedia');
    Route::post('province-partners/ckmedia', 'ProvincePartnerController@storeCKEditorImages')->name('province-partners.storeCKEditorImages');
    Route::resource('province-partners', 'ProvincePartnerController');

    // National Partners
    Route::delete('national-partners/destroy', 'NationalPartnerController@massDestroy')->name('national-partners.massDestroy');
    Route::post('national-partners/media', 'NationalPartnerController@storeMedia')->name('national-partners.storeMedia');
    Route::post('national-partners/ckmedia', 'NationalPartnerController@storeCKEditorImages')->name('national-partners.storeCKEditorImages');
    Route::resource('national-partners', 'NationalPartnerController');

    // Directorates
    Route::delete('directorates/destroy', 'DirectorateController@massDestroy')->name('directorates.massDestroy');
    Route::resource('directorates', 'DirectorateController');

    // Units
    Route::delete('units/destroy', 'UnitController@massDestroy')->name('units.massDestroy');
    Route::resource('units', 'UnitController');

    // Professions
    Route::delete('professions/destroy', 'ProfessionController@massDestroy')->name('professions.massDestroy');
    Route::resource('professions', 'ProfessionController');

    // Etablissements
    Route::delete('etablissements/destroy', 'EtablissementController@massDestroy')->name('etablissements.massDestroy');
    Route::post('etablissements/media', 'EtablissementController@storeMedia')->name('etablissements.storeMedia');
    Route::post('etablissements/ckmedia', 'EtablissementController@storeCKEditorImages')->name('etablissements.storeCKEditorImages');
    Route::resource('etablissements', 'EtablissementController');

    // Unite Regionals
    Route::delete('unite-regionals/destroy', 'UniteRegionalController@massDestroy')->name('unite-regionals.massDestroy');
    Route::post('unite-regionals/media', 'UniteRegionalController@storeMedia')->name('unite-regionals.storeMedia');
    Route::post('unite-regionals/ckmedia', 'UniteRegionalController@storeCKEditorImages')->name('unite-regionals.storeCKEditorImages');
    Route::resource('unite-regionals', 'UniteRegionalController');

    // Questions
    Route::delete('questions/destroy', 'QuestionController@massDestroy')->name('questions.massDestroy');
    Route::post('questions/media', 'QuestionController@storeMedia')->name('questions.storeMedia');
    Route::post('questions/ckmedia', 'QuestionController@storeCKEditorImages')->name('questions.storeCKEditorImages');
    Route::resource('questions', 'QuestionController');

    // Unit Details
    Route::delete('unit-details/destroy', 'UnitDetailsController@massDestroy')->name('unit-details.massDestroy');
    Route::post('unit-details/media', 'UnitDetailsController@storeMedia')->name('unit-details.storeMedia');
    Route::post('unit-details/ckmedia', 'UnitDetailsController@storeCKEditorImages')->name('unit-details.storeCKEditorImages');
    Route::resource('unit-details', 'UnitDetailsController');
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
// Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
    }
});
