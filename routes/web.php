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
*/
Route::get('/', function () {
    return view('index');
})->name('front.index');
Auth::routes();
Route::get('/home', 'HomeController@index')->name('admin.home');
Route::get('/dashboard', 'DashboardController@index')->name('admin.dashboard');
// Local dev specific routes
if (App::environment('local')) {
    // Route::get('decompose', '\Lubusin\Decomposer\Controllers\DecomposerController@index');
}
Route::group(['middleware' => ['auth'], 'prefix' => 'admin'], function () {
    Route::resource('roles', 'RolesController');
    Route::post('/getRoleData', 'RolesController@getRoleData');

    Route::resource('permissions', 'PermissionController');
    Route::post('/getPermissionData', 'PermissionController@getPermissionData');

      //Users Section
    Route::resource('users', 'UsersController');
    Route::post('/getUserData', 'UsersController@getUserData');
    Route::post('/validateEmail', 'UsersController@validateEmail');

    Route::resource('modules', 'ModulesController');
    Route::post('/getModuleData', 'ModulesController@getModuleData');
    Route::post('generateModuleUrl', 'ModulesController@generateModuleUrl');

    Route::resource('widgets', 'WidgetsController');
    Route::post('/getWidgetData', 'WidgetsController@getWidgetData');

    Route::resource('groups', 'GroupController');
    Route::post('/getGroupData', 'GroupController@getGroupData');
});

/*
 * Teamwork routes
 */
Route::group(['prefix' => 'teams', 'namespace' => 'Teamwork'], function () {
    Route::get('/', 'TeamController@index')->name('teams.index');
    Route::get('create', 'TeamController@create')->name('teams.create');
    Route::post('teams', 'TeamController@store')->name('teams.store');
    Route::get('edit/{id}', 'TeamController@edit')->name('teams.edit');
    Route::put('edit/{id}', 'TeamController@update')->name('teams.update');
    Route::delete('destroy/{id}', 'TeamController@destroy')->name('teams.destroy');
    Route::get('switch/{id}', 'TeamController@switchTeam')->name('teams.switch');

    Route::get('members/{id}', 'TeamMemberController@show')->name('teams.members.show');
    Route::get('members/resend/{invite_id}', 'TeamMemberController@resendInvite')->name('teams.members.resend_invite');
    Route::post('members/{id}', 'TeamMemberController@invite')->name('teams.members.invite');
    Route::delete('members/{id}/{user_id}', 'TeamMemberController@destroy')->name('teams.members.destroy');

    Route::get('accept/{token}', 'AuthController@acceptInvite')->name('teams.accept_invite');
});
