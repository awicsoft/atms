<?php

class myController extends BaseController{

function mainPage(){
$pageName = "Main Page";
$name = "sajad";

	return View::make('template')->with('name',$name)->with('pageName',$pageName);

}

function aboutPage(){
$pageName = "About Page";
$name = "sajad";

	return View::make('template')->with('name',$name)->with('pageName',$pageName);

}

}

?> 