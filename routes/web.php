<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
| Middleware options can be located in `app/Http/Kernel.php`
|
*/

// Homepage Route
Route::group(['middleware' => ['web', 'checkblocked']], function () {
    Route::get('/', 'ListingController@home')->name('home');
    Route::get('/lelang', 'ListingController@list_objek');
    Route::get('/hasil-lelang', 'ListingController@list_hasil');
});

// Authentication Routes
Auth::routes();

// Public Routes
Route::group(['middleware' => ['web', 'checkblocked']], function () {

    // Activation Routes
    Route::get('/activate', ['as' => 'activate', 'uses' => 'Auth\ActivateController@initial']);

    Route::get('/activate/{token}', ['as' => 'authenticated.activate', 'uses' => 'Auth\ActivateController@activate']);
    Route::get('/activation', ['as' => 'authenticated.activation-resend', 'uses' => 'Auth\ActivateController@resend']);
    Route::get('/exceeded', ['as' => 'exceeded', 'uses' => 'Auth\ActivateController@exceeded']);

    // Socialite Register Routes
    Route::get('/social/redirect/{provider}', ['as' => 'social.redirect', 'uses' => 'Auth\SocialController@getSocialRedirect']);
    Route::get('/social/handle/{provider}', ['as' => 'social.handle', 'uses' => 'Auth\SocialController@getSocialHandle']);

    // Route to for user to reactivate their user deleted account.
    Route::get('/re-activate/{token}', ['as' => 'user.reactivate', 'uses' => 'RestoreUserController@userReActivate']);
});

// Registered and Activated User Routes
Route::group(['middleware' => ['auth', 'activated', 'checkblocked']], function () {

    // Activation Routes
    Route::get('/activation-required', ['uses' => 'Auth\ActivateController@activationRequired'])->name('activation-required');
    Route::get('/logout', ['uses' => 'Auth\LoginController@logout'])->name('logout');
});

// Registered and Activated User Routes
Route::group(['middleware' => ['auth', 'activated', 'checkblocked']], function () {

    //  Homepage Route - Redirect based on user role is in controller.
    Route::get('/home', [
        'as' => 'public.home',   
        'uses' => 'UserController@index'
        ]);

    // Show users profile - viewable by other users.
    Route::get('profile/{username}', [
        'as'   => '{username}',
        'uses' => 'ProfilesController@show',
    ]);
});

// Registered, activated, and is current user routes.
Route::group(['middleware' => ['auth', 'activated', 'currentUser', 'checkblocked']], function () {

    // User Profile and Account Routes
    Route::resource(
        'profile',
        'ProfilesController', [
            'only' => [
                'show',
                'edit',
                'update',
                'create',
            ],
        ]
    );

    Route::get('/detail/objek/{id}', 'ListingController@show');
    Route::post('/bid/{id_nipl}/{id_listing}', 'ListingController@submit_bid');

    Route::put('profile/{username}/updateUserAccount', [
        'as'   => '{username}',
        'uses' => 'ProfilesController@updateUserAccount',
    ]);
    Route::put('profile/{username}/updateUserPassword', [
        'as'   => '{username}',
        'uses' => 'ProfilesController@updateUserPassword',
    ]);
    Route::delete('profile/{username}/deleteUserAccount', [
        'as'   => '{username}',
        'uses' => 'ProfilesController@deleteUserAccount',
    ]);

    // Route to show user avatar
    Route::get('images/profile/{id}/avatar/{image}', [
        'uses' => 'ProfilesController@userProfileAvatar',
    ]);

    // Route to upload user avatar.
    Route::post('avatar/upload', ['as' => 'avatar.upload', 'uses' => 'ProfilesController@upload']);
});

// Registered, activated, and is admin routes.
Route::group(['middleware' => ['auth', 'activated', 'role:admin', 'checkblocked']], function () {
    
    // Master Objek
    Route::get('/objek', 'MasterController@objek_index');
    Route::get('/add/{nm_kategori}/{nm_subkategori}', 'MasterController@objek_properti_create');
    Route::post('/add/{nm_kategori}/{nm_subkategori}', 'MasterController@objek_properti_store');
    Route::get('detail/properti/{nm_subkategori}/{id}', 'MasterController@objek_properti_show');
    Route::get('/edit/properti/{nm_subkategori}/{id}', 'MasterController@objek_properti_edit');
    Route::patch('/edit/properti/{nm_subkategori}/{id}', 'MasterController@objek_properti_update');
    Route::delete('/delete/properti/{nm_subkategori}/{id}', 'MasterController@objek_properti_destroy');

    // Master Pemilik
    Route::get('/pemilik', 'MasterController@pemilik_index');
    Route::get('/add/pemilik', 'MasterController@pemilik_create');
    Route::post('/add/pemilik', 'MasterController@pemilik_store');
    Route::get('/edit/pemilik/{id}', 'MasterController@pemilik_edit');
    Route::patch('/edit/pemilik/{id}', 'MasterController@pemilik_update');
    Route::delete('/delete/pemilik/{id}', 'MasterController@pemilik_destroy');

    // Master Listing
    Route::get('/listing', 'ListingController@index');
    Route::get('/add/listing/{nm_kategori}/{nm_subkategori}/{id}', 'ListingController@create');
    Route::post('/add/listing/{nm_kategori}/{nm_subkategori}/{id}', 'ListingController@store');

    // Master Bidder
    Route::get('/bidder', 'MasterController@bidder_index');
    Route::get('/update/bidder/{id}', 'MasterController@bidder_edit');
    Route::post('/update/bidder/{id}', 'MasterController@bidder_store_or_update');

    // Master Dropdown
    Route::get('ajax/dropdown/kota/{id_provinsi}', 'DropdownController@kota');
    Route::get('ajax/dropdown/kecamatan/{id_kota}', 'DropdownController@kecamatan');
    Route::get('ajax/dropdown/kelurahan/{id_kecamatan}', 'DropdownController@kelurahan');
    
    Route::resource('/users/deleted', 'SoftDeletesController', [
        'only' => [
            'index', 'show', 'update', 'destroy',
        ],
    ]);

    Route::resource('users', 'UsersManagementController', [
        'names' => [
            'index'   => 'users',
            'destroy' => 'user.destroy',
        ],
        'except' => [
            'deleted',
        ],
    ]);
    Route::post('search-users', 'UsersManagementController@search')->name('search-users');

    Route::resource('themes', 'ThemesManagementController', [
        'names' => [
            'index'   => 'themes',
            'destroy' => 'themes.destroy',
        ],
    ]);

    Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
    Route::get('routes', 'AdminDetailsController@listRoutes');
    Route::get('active-users', 'AdminDetailsController@activeUsers');
});

Route::redirect('/php', '/phpinfo', 301);
