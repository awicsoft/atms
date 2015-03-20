<?php

class RecoverPassword extends BaseController{

	public function recoverPasswordForm(){
		//return "sss";
		 	return View::make('recoverPassword');


	}
 public	function recoverPasswordToken($code){

 	//return $code;

 	$up  = User::where('code' ,$code );


 	if(!$up->count())
 		return Redirect::intended('recoverPassword');
 	
 	$user = $up->first();


 	$np = $user->temp_password;


	$np = Hash::make($np);
 	

 	$up->update(['password' => $np ,'code' => '' ,'temp_password' => '']);


  		return Redirect::intended('login');


 }

private	function sendRecoveryEmail($user,$npassword){

		Mail::send('emails.auth.reminder',['user'=>$user , 'npassword' => $npassword] ,function($message) use ($user){

			$message->to($user->email, $user->username)->subject('Your new Password');

		});



	}

	public function recoverPassword(){
	
		$email = Input::get('email');

		if(empty($email))
			return View::make('recoverPassword',['message' => "You provide Wrong Email"]);

		
		$user = User::where('email' , $email);

		if(!$user->count())
			return View::make('recoverPassword',['message' => "You provided  Email is not in our Record"]);
		
		$up = $user;
			$user= $user->first();
			if($user->temp_password!='')
				return View::make('recoverPassword',['message' => "We have already send you the mail check your inbox or spam folder"]);
		
			
		$npassword = str_random(5);
		$temp_password = $npassword;
		$code = str_random(20);	
		$user->code = $code;

			$up->update(['temp_password' => $temp_password , 'code' => $code]);

		
			$this->sendRecoveryEmail($user,$npassword);


			return View::make('recoverPassword',['message' => "We Have Sent You an Email having New Passowrd and Activation Link"]);

		

		return View::make('recoverPassword',['message' => "We cannot Reover the password"]);


	}
}

?> 