<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/
Route::get('/', function()
{
    return View::make('frontend'); 
});
/*Route::get('/about','myController@aboutPage');
//Route::get('usama/', function()
//{
//	$name = "sajad";

//	return View::make('usama')->with('name',$name);
	
//});

*/


Route::get('/users', function()
{
    return "ussssama";
})->before('auth');


Route::get('/register', 'HomeController@registerPage')->before('auth');;
Route::post('/register', 'UserController@register')->before('auth');;

//////ADMIN PANEL ROUTES
Route::get('/adminlogout', 'UserController@logout')->before('auth');;


Route::post('/adsenserate', 'UserController@adsenserate')->before('auth');



Route::get('/locations', 'UserController@linklocPage')->before('auth');;
Route::post('/locations', 'UserController@addlinkloc')->before('auth');;
Route::post('/deleteLoc', 'UserController@deleteLoc')->before('auth');





Route::post('/autoAddLinks', 'UserController@autoAddLinks')->before('auth');
Route::post('/deleteLink', 'UserController@deleteLink')->before('auth');



Route::post('/enableuser', 'UserController@enableuser')->before('auth');
Route::post('/disableuser', 'UserController@disableuser')->before('auth');
Route::post('/holduser', 'UserController@holduser')->before('auth');
Route::post('/unholduser', 'UserController@unholduser')->before('auth');

Route::post('/adminusercat', 'UserController@adminusercat')->before('auth');
Route::get('/adminusercat', 'UserController@adminusercatPage')->before('auth');

Route::get('/adminrates', 'UserController@adminratesPage')->before('auth');
Route::post('/adminrates', 'UserController@adminrates')->before('auth');

Route::get('/linkcat', 'UserController@linkcatPage')->before('auth');
Route::post('/linkcat', 'UserController@addlinkcat')->before('auth');
Route::post('/deleteLinkCat', 'UserController@deleteLinkCat')->before('auth');



Route::get('/sendNotification','UserController@sendNotificationPage')->before('auth');
Route::post('/sendNotification','UserController@sendNotification')->before('auth');


Route::get('/login', 'UserController@loginPage');
Route::post('/login', 'UserController@login');

Route::get('/profile', 'UserController@profilePage')->before('auth');;
Route::post('/profile', 'UserController@updatePassword')->before('auth');;


Route::get('/stats', 'UserController@indexPage')->before('auth');;

Route::get('/index', 'UserController@indexPage')->before('auth');;
Route::get('/users', 'UserController@usersPage');
Route::get('/viewUser/', 'UserController@viewUserPage');
Route::get('/viewUser/{code}', 'UserController@viewUserPage');
		


////ADMIN PAnEL ROUTS ENDS




Route::get('/recoverPasswordToken/{code}','RecoverPassword@recoverPasswordToken');

Route::get('/recoverPassword','RecoverPassword@recoverPasswordForm');
Route::post('/recoverPassword','RecoverPassword@recoverPassword');


Route::get('/login', 'HomeController@loginPage');
Route::post('/login', 'UserController@login');

//working rotues



Route::get('/', 'UserController@index')->before('auth');
Route::get('/logout', 'UserController@logout');

Route::get('/index', 'UserController@index')->before('auth');
Route::get('/user/index', 'UserController@index')->before('auth');


Route::get('/links', 'UserController@adminlinksPage')->before('auth');;
Route::post('/links', 'AdminController@addadminlinks')->before('auth');;
//working rotues end
/*
Route::get('/user/links', 'UserController@links1');
Route::get('/user/stats', 'UserController@stats');
Route::get('/user/profile', 'UserController@profile');
Route::get('/user/security', 'UserController@security');
Route::get('/user/notification', 'UserController@notifications');

Route::get('/user/logout', 'UserController@logout');
Route::post('/user/updatePersonal', 'UserController@updatePersonel');
Route::post('/user/updateAddress', 'UserController@updateAddress');
Route::post('/user/updatePassword', 'UserController@updatePassword');
*/
/*Route::get('/users/','UserController@all');
Route::get('/users/{username}',function($username){
	$sUser = new UserController();

	return $sUser->specific($username);
	//return $username;

});
*/