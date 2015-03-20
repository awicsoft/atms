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
Route::get('/addRToken', function()
{
$rToken  = Input::get('rToken');
    Analytics::where('ID',1)->update(['rtoken' => $rToken]);
    //return Redirect::to('analytics');
    return "Added Refress Token";
});
Route::get('/addToken', function()
{
$aToken  = Input::get('aToken');
    Analytics::where('ID',1)->update(['token' => $aToken]);
  //  return Redirect::to('analytics');
    return "Added Acess Token";
});
Route::get('/', function()
{
    return View::make('frontend'); 
});

Route::get('/analytics', 'AnalyticsController@analytics');

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





Route::get('/recoverPasswordToken/{code}','RecoverPassword@recoverPasswordToken');

Route::get('/recoverPassword','RecoverPassword@recoverPasswordForm');
Route::post('/recoverPassword','RecoverPassword@recoverPassword');


Route::get('/register', 'HomeController@registerPage');
Route::post('/register', 'UserController@register');
Route::get('/login', 'HomeController@loginPage');
Route::post('/login', 'UserController@login');


Route::get('/index', 'UserController@index')->before('auth');;
Route::get('/user', 'UserController@index')->before('auth');;
Route::get('/links', 'UserController@links1')->before('auth');;
Route::get('/stats', 'UserController@stats')->before('auth');;
Route::get('/profile', 'UserController@profile')->before('auth');;
Route::get('/security', 'UserController@security')->before('auth');;
Route::get('/notification', 'UserController@notifications')->before('auth');;

Route::get('/logout', 'UserController@logout');
Route::post('/updatePersonal', 'UserController@updatePersonel')->before('auth');;
Route::post('/updateAddress', 'UserController@updateAddress')->before('auth');;
Route::post('/updatePassword', 'UserController@updatePassword')->before('auth');;

/*Route::get('/users/','UserController@all');
Route::get('/users/{username}',function($username){
	$sUser = new UserController();

	return $sUser->specific($username);
	//return $username;

});
*/