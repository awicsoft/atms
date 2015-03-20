<?php
class UserController extends BaseController{
		
	
		
	function all(){
		$users = User::all();

		return View::make('users',['users' => $users]);

	}
	
	function specific($username){
		$user = User::whereUsername($username)->first();
		if($user==NULL)
			return "User Not Found";
		return $user->username;
	}




	function notifications(){
		if($user = $this->isLogged()){
                    
                    $notifications = Notification::where('userID',$user->ID)->get();
			return View::make('usernotifications',['user' =>$user,'notifications'=>$notifications]);

		}
		  return Redirect::intended('./login');


	}
	function index(){

		if($user = $this->isLogged()){

			
                        $date = date('Y-m-d');
                        $totalEarning = Sharing::where('username',$user->username)->sum('earning');
                        $todayEarning = Sharing::where('username',$user->username)->where('date',$date)->sum('earning');
                        $sdate = date('Y-m-d', strtotime('-1 day'));
                        $yesterdayEarning = Sharing::where('username',$user->username)->where('date',$sdate)->sum('earning');
                         $sdate = date('Y-m-d', strtotime('-7 day'));
                          $weekEarning = Sharing::where('username',$user->username)->where('date','>',$sdate)->sum('earning');
                          $categorys = LinkCategory::all();  
                          
                        $category = Input::get('category');
                        
                         $fact = 20;
			$btn = Input::get('btn');

			$pre = Input::get('pre');
                        if($category != "")
                        $total = Links::where('category_ID',$category)->count();
			else 
                            $total = Links::count();
                        if($btn=="<" && $pre!=0)
				$pre -=$fact;
			else if($btn == ">" && $pre + $fact<$total)
				$pre +=$fact;

			$upto = $fact;
                        
                        
                        if($category=="")
                            $links = Links::skip($pre)->take($upto)->get();
                        else{
                            $links = Links::where('category_ID',$category)->skip($pre)->take($upto)->get();    
                            
                        }  
                          
                     
			
                        
                       
                        
                        
                        
                        return View::make('useri',[
                            'user' =>$user ,
                            'links' => $links,
                            'todayEarning' =>$todayEarning ,
                            'yesterdayEarning'=>$yesterdayEarning,
                            'weekEarning'=>$weekEarning,
                            'categorys'  =>$categorys,
                            'pre' =>$pre,
                            'total' =>$total,
                            'selected' => $category
                           
                                ]);
		
		}
		  return Redirect::intended('./login');



	}
	function links1(){

		if($user = $this->isLogged()){
			return View::make('userlinks',['user' =>$user]);

		} return Redirect::intended('./login');

	
	}
	function stats(){
		if($user = $this->isLogged()){
                    $stats = Sharing::where('username',$user->username)->orderBy('date', 'desc')->get();
                    $graphDates = Sharing::select('date')->distinct('date')->where('username',$user->username)->orderBy('date', 'asc')->get();
                    $graphUnitedStates = Sharing::select('visits','earning')->where('username',$user->username)->where('country','United States')->orderBy('date', 'asc')->get();
                   $graphAustralia = Sharing::select('visits','earning')->where('username',$user->username)->where('country','Australia')->orderBy('date', 'asc')->get(); 
                $graphUnitedKingdom = Sharing::select('visits','earning')->where('username',$user->username)->where('country','United Kingdom')->orderBy('date', 'asc')->get();
                $graphCanada = Sharing::select('visits','earning')->where('username',$user->username)->where('country','Canada')->orderBy('date', 'desc')->get();
                $graphOther = Sharing::select('visits','earning')->where('username',$user->username)->where('country','Other')->orderBy('date', 'asc')->get();    
			
			
			return View::make('userstats',[
			'user' =>$user,
			'stats'=>$stats ,
			'graphDates' =>$graphDates,
			'graphUnitedStates' =>$graphUnitedStates ,
			'graphAustralia' => $graphAustralia ,
			'graphUnitedKingdom' => $graphUnitedKingdom ,
			'graphCanada' => $graphCanada,
			'graphOther' => $graphOther 
			 ]);
		}
		 return Redirect::intended('./login');


	}
	function profile(){

		if($user = $this->isLogged()){
			$userID = $this->toUserID($user->username);
			$address = Address::where('userID' , $userID)->first();

			return View::make('userprofile',['user' =>$user,'address' =>$address]);
		
		}
		 return Redirect::intended('./login');
	}
	function profile1($message){

		if($user = $this->isLogged()){
			$userID = $this->toUserID($user->username);
			$address = Address::where('userID' , $userID)->first();

			return View::make('userprofile',['message' =>$message, 'user' =>$user,'address' =>$address]);
		
		}
		 return Redirect::intended('./login');
	}
	function security(){
		if($user = $this->isLogged()){
			return View::make('usersecurity',['user' =>$user]);
		}
		 return Redirect::intended('./login');	
	}





		function  isLogged(){

		if(!Session::has('user') )
			return 0;

		$u  = Session::get('user');
		//echo "$u->username";
		//echo "$u->password";
		if($u == NULL)
			return 0;	
		$user = array(
        'username' => $u->username,
        'password' => $u->password

 		  );

		if (Auth::attempt($user)){
				
				if(Auth::check()){
					$user = User::whereUsername($u->username)->first();
					$user->password =  $u->password;
					return $user;

				}
			}
		
		return 0;

	}
function isUsernameAlreadyExits($username){
		$user = User::whereUsername($username)->first();
		if($user==NULL)
			return false;
		return true;


	}
	
	function isEmailAlreadyExits($email){
		$user = User::whereEmail($email)->first();
		if($user==NULL)
			return false;
		return true;


	}

	function toUserID($username){

		$user = User::whereUsername($username)->first();
			if($user==NULL)
				 return 0;
		return $user->ID;

	}
	function register(){
		try {
		
			
			$email = Input::get('email');
			$username = Input::get('username');
			$password = Input::get('password');
			$apassword = Input::get('rpassword');
			$message = "";
		

			if(empty($email) || empty($username) || empty($password) || empty($apassword) )
					throw new Exception("*fields are Mandotory");
			
			if($password != $apassword)
				throw new Exception("Both Password Not Matched");

			if($this->isUsernameAlreadyExits($username))
					throw new Exception("Username Already Registered");
			if($this->isEmailAlreadyExits($email))
					throw new Exception("Email Already Registered");
			else{
				
				
			
			
				

				$this->registerUser($username,$password,$email);
					
			return View::make('login',['message' => "You are Registered Sucess fully"]);
				
			}

			return View::make('register',['message' => $message,'username' => $username,'email' => $email]);
		}catch(Exception $e){
			$message = $e->getMessage();
			return View::make('register',['message' => $message,'username' => $username,'email' => $email ]);


		}


	}

function registerUser($username,$password,$email){
		
		$categoryID =1;
		$password = Hash::make($password);
		User::insert(

			array(
				'username' => $username,
				'password' => $password,
				'email' =>$email,
				'category_ID' => $categoryID
			)
		);
		$userID = $this->toUserID($username);
		Address::insert(
			array(
				'userID' => $userID

				)
			);

	}	

 
function logout(){
		
		Auth::logout();
		Session::flush();
		 return Redirect::intended('./login');
		
	}

	function login(){
		$username = Input::get('username');
		$password = Input::get('password');
		
		$user = array(
        'username' => Input::get('username'),
        'password' => Input::get('password')

 		  );   




		
		
		if (Auth::attempt($user,true)){
				
				if(Auth::check()){
					$user = User::whereUsername($username)->first();
					$user->password  = $password;
					Session::put('user', $user);
			
					
					  return Redirect::intended('user');

				}


			//	Auth::user()->login();
			//	 Auth::user()->lastLogin = Carbon::now();
			//	  Auth::user()->save();
				//return $email = Auth::user()->email;
			 
			}

			 return  View::make('login',['message' => "WRONG DETAILS"]);
			

	}

	function updatePersonel(){
			if($user = $this->isLogged()){
				$name = Input::get('name');
				$email = Input::get('email');
				
				if(!empty($name))
					User::where('ID', $user->ID)->update(array('name' => $name ));
				
				if(empty($email))
					return  $this->profile1("Email Field Cannot be Empty");

				if($email != $user->email && $this->isEmailAlreadyExits($email) )
				{

					return  $this->profile1("Email is already Registered with some other Account");
				}


				User::where('ID', $user->ID)->update(array('email' => $email ));


			return $this->profile1("Sucessfully Updated");

		}
		  return Redirect::intended('./login');



	}

	function updateAddress(){
			if($user = $this->isLogged()){

			$line1= Input::get('line1');
			$line2= Input::get('line2');
			$city = Input::get('city');
			$country = Input::get('country');
			$zipcode = Input::get('zipcode');
			if(!empty($line1))
					Address::where('userID', $user->ID)->update(array('line1' => $line1 ));
			if(!empty($line2))
					Address::where('userID', $user->ID)->update(array('line2' => $line2 ));
				
				
			if(!empty($city))
					Address::where('userID', $user->ID)->update(array('city' => $city ));
			if(!empty($country))
					Address::where('userID', $user->ID)->update(array('country' => $country ));
			if(!empty($zipcode))
					Address::where('userID', $user->ID)->update(array('zipcode' => $zipcode ));
					
		


			return $this->profile();

		}
		  return Redirect::intended('./login');



	}
	function updatePassword(){
			if($user = $this->isLogged()){

				$cpassword = Input::get('cpassword');
			$npassword = Input::get('npassword');
			$apassword = Input::get('rpassword');
				
			//	return "c : $cpassword n: n$npassword r:$apassword";
			if(empty($cpassword) || empty($npassword) || empty($apassword))
			return $this->profile1( "*Fields are Mandotory" );
			
			if($cpassword != $user->password)
				
				return	$this->profile1("*Current Password Not Matched" );
			
			if($apassword != $npassword)
				return	$this->profile1("*Both Password Not Matched" );
			
			$npassword = Hash::make($npassword);

			User::where('ID', $user->ID)
			->update(array('password' => $npassword));
				$user = $this->isLogged();
				
			return	$this->profile1("Password Update Sucessfully");
			
	

			return $this->profile();

		}
		  return Redirect::intended('./login');



	}



}

?>