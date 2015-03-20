<?php
class UserController extends BaseController{
		
	
		
	function all(){
		$users = SUser::all();

		return View::make('users',['users' => $users]);

	}
	
	function specific($username){
		$user = SUser::whereUsername($username)->first();
		if($user==NULL)
			return "User Not Found";
		return $user->username;
	}




	function notifications(){
		if($user = $this->isLogged()){

			return View::make('usernotifications',['user' =>$user]);

		}
		  return Redirect::intended('./login');


	}
	function index(){
                
                
                return View::make('adminindex');

			
		
		



	}
	function links1(){

		if($user = $this->isLogged()){
			return View::make('userlinks',['user' =>$user]);

		} return Redirect::intended('./login');

	
	}
	function stats(){
		if($user = $this->isLogged()){
			return View::make('userstats',['user' =>$user]);
		}
		 return Redirect::intended('./login');


	}
	function profile(){

		
			$userID = $this->toUserID($user->username);
			$address = Address::where('userID' , $userID)->first();

			return View::make('adminprofile',['user' =>$user]);
		
		
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
					$user = User::whereUsername($u->username  )->first();
                                       if($user==NULL)
                                           return 0;
                                        $user->password =  $u->password;
					return $user;

				}
			}
		
		return 0;

	}
function isUsernameAlreadyExits($username){
		$user = SUser::whereUsername($username)->first();
		if($user==NULL)
			return false;
		return true;


	}
	
	function isEmailAlreadyExits($email){
		$user = SUser::whereEmail($email)->first();
		if($user==NULL)
			return false;
		return true;


	}

	function toUserID($username){

		$user = SUser::whereUsername($username)->first();
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
			
					
					  return Redirect::intended('/');

				}


			//	Auth::user()->login();
			//	 Auth::user()->lastLogin = Carbon::now();
			//	  Auth::user()->save();
				//return $email = Auth::user()->email;
			 
			}

			 return  View::make('login',['message' => "WRONG DETAILS"]);
			

	}
      

	function updatePersonel(){
		
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
//admin panel function
        public function linklocPage(){
			if($this->isLogged()){
				$pre=0;
				$total=0;
				$locations = LinkLoc::all();
				return View::make('linkloc',[
					'pre' => $pre,
					'total' => $total,
					'locations'=>$locations
					]);

			}
			return Redirect::intended('user/index');

	}
public function linkcatPage(){
		
				$pre=0;
				$total=0;
				$categorys = LinkCategory::all();
				
				return View::make('linkcat',[
					'pre' => $pre,
					'total' => $total,
					'categorys'=>$categorys
					]);

			

	}
function lcatiii($links){
	$links1 = [];
	foreach ($links as $link) {
		$LinkCategory = LinkCategory::where('ID',$link->category_ID)->first();
		
		$link->category_ID = $LinkCategory;
		

		

		array_push($links1, $link);



	}

	return $links1;

}
public function adminlinksPage(){
			
				$fact = 2;
			$btn = Input::get('btn');

			$pre = Input::get('pre');

			
				$total=Links::all()->count();


			if($btn=="<" && $pre!=0)
				$pre -=$fact;
			else if($btn == ">" && $pre + $fact<$total)
				$pre +=$fact;

			$upto = $fact;




				$categorys = LinkCategory::all();
				$links = Links::skip($pre)->take($upto)->get();
				$links = $this->lcatiii($links);
				return View::make('adminlinks',[
					'pre' => $pre,
					'total' => $total,
					'categorys'=>$categorys,
					'links'=>$links
					]);

			

	}

function rateiii($rates){
	$rates1 = [];
	foreach ($rates as $rate) {
		$UserCategory = UserCategory::where('ID',$rate->user_category_ID)->first();
		
		$rate->user_category_ID = $UserCategory;
		

		$location = LinkLoc::where('ID',$rate->link_loc_ID)->first();

		$rate->link_loc_ID = $location;

		array_push($rates1, $rate);



	}

	return $rates1;

}
public function adsenserate(){
	$rate = Input::get('rate');
	
	AdsenseRate::where('ID',1)->update(['rate'=>$rate]);
	return Redirect::to('adminrates');


}
public function adminratesPage(){
		
	
			

			$categorys = UserCategory::all();
			
			$linkLoc = LinkLoc::all();	
			$rates = Rate::all();
			$rates = $this->rateiii($rates);
			$adsenseRate  = AdsenseRate::where('ID',1)->first()->rate;
				return View::make('adminrates',['categorys' =>$categorys,'locations' =>$linkLoc, 'rates' => $rates ,'adsenseRate' =>$adsenseRate]);

		
	}
	public function adminusercatPage(){
		
		
				$categorys = UserCategory::all();
			

				return View::make('adminusercat',['categorys' =>$categorys]);

		
	}
	function profile1($message){


				return View::make('adminprofile',['message' => $message]);

		


	}
	function sendNotificationPage(){


			$pre = 0;
			$userID = Input::get('userID');



			$total = 0;

			$notifications = Notification::all();
			return View::make('adminnotification',['pre' =>$pre ,'total' =>$total,'notifications'=>$notifications,'userID'=>$userID]);


	}
	function profilePage(){

				return View::make('adminprofile');



	}



	public function indexPage(){

			return View::make('adminindex');
	}
	
	public function categoryiii($users){
		$users1 = [];
		foreach($users as $user){

		$category = UserCategory::where('ID',$user->category_ID)->first();
		$user->category_ID = $category->title;

		array_push(	$users1,$user);

		}
		return $users1;
	}
	public function usersPage(){
	
			$categoryID = Input::get('category');


			if(empty($categoryID) || $categoryID==0)
				$total = SUser::all()->count();
			
			else	
				$total = SUser::where('category_ID',$categoryID)->count();

			

			$fact = 2;
			$btn = Input::get('btn');

			$pre = Input::get('pre');
			if($btn=="<" && $pre!=0)
				$pre -=$fact;
			else if($btn == ">" && $pre + $fact<$total)
				$pre +=$fact;

			$upto = $fact;

			if(empty($categoryID) || $categoryID==0)
					$users = SUser::skip($pre)->take($upto)->get();
			else
				$users = SUser::where('category_ID',$categoryID)->skip($pre)->take($upto)->get();
			
			$users=$this->categoryiii($users);

			$categorys = UserCategory::all();
			return View::make('adminusers',['users' =>$users ,'pre' => $pre ,'total' => $total,'categorys'=>$categorys,'categoryID' =>$categoryID]);
		


	}
	
	public function viewUserPage(){
		
			$ID = Input::get('userID');
			$user = SUser::where('ID',$ID)->first();
			$address = Address::where('userID',$ID)->first();

			return View::make('adminViewUser',['user'=>$user , 'address'=>$address]);
		

		

	}

		
	function isValid($username,$password){

		return Admin::where('username',$username)->where('password',$password)->first();

	}
	



	


	function holduser(){
		
		$userID = Input::get('ID');
		$pre = Input::get('pre');
		SUser::where('ID',$userID)->update(['hold'=>1]);
			return $this->usersPage();
			return Redirect::to("users?pre=$pre");

	}
	function unholduser(){
			

		$userID = Input::get('ID');
		$pre = Input::get('pre');
		SUser::where('ID',$userID)->update(['hold' => 0]);
		return $this->usersPage();
		return Redirect::to("users?pre=$pre"); 

	}
	function enableuser(){
		
		$pre = Input::get('pre');


		$userID = Input::get('ID');

		SUser::where('ID',$userID)->update(['enable' => 1]);
			return $this->usersPage();
			return Redirect::to("users?pre=$pre");
	}
	function disableuser(){
		
		$pre = Input::get('pre');
		$userID = Input::get('ID');

		SUser::where('ID',$userID)->update(['enable' => 0]);
		return $this->usersPage();
		return Redirect::to("users?pre=$pre");
	}

	function sendNotification(){
		if(!$this->isLogged()) 
			return "";
		$userID = Input::get('userID');
		$title = Input::get('title');
		$details = Input::get('details');



		if($userID != "ALL")
			Notification::insert(['userID'=>$userID,'title' => $title , 'details' => $details]);
		else if($userID == "ALL")	
			Notification::insert(['userID'=>0,'title' => $title , 'details' => $details ,'allFlag' =>1]);
			

		return $this->sendNotificationPage();

	}

	function adminusercat(){
		
		$title = Input::get('title');

			UserCategory::insert(['title' => $title]);

		return $this->adminusercatPage();	

		
	}
	public function adminrates(){
		

		$categoryID = Input::get('category');
		$loc_ID = Input::get('location');
		$rate = Input::get('rate');

		if(empty($loc_ID) ||empty($categoryID))
			return "ERROR : First add some locations or add some categories";

		Rate::insert(['user_category_ID' => $categoryID , 'link_loc_ID' => $loc_ID , 'rate' => $rate]);
		return $this->adminratesPage();


	}
		public function addlinkcat(){
	

			$title = Input::get('title');

			LinkCategory::insert([
				'title' => $title

				]);
			return $this->linkcatPage();



		}
		public function deleteLinkCat(){
			
			$ID = Input::get('ID');		

			LinkCategory::where('ID' , $ID)->delete();
			return $this->linkcatPage();
		}

		public function urlToThuburl($url){


			$xml = file_get_contents("http://img.linkify.cash/?url=$url");
			return $xml;

		}

		public	function getTitle($Url){
	    $str = file_get_contents($Url);
			    if(strlen($str)>0){
			        preg_match("/\<title\>(.*)\<\/title\>/",$str,$title);
			        return $title[1];
			    }
			    return "";
		}
		public function manualAddLinks(){

			$url = Input::get('url');
			
			$categoryID = Input::get('category');
			
			 $thumb_url = $this->urlToThuburl($url);
			
			$title = $this->getTitle($url);



			Links::insert([
				'title'=>$title,
				
				'url'=>$url,
				'thumb_url' =>$thumb_url,
				'category_ID'=>$categoryID

				]);

			return $this->adminlinksPage();		
		}
		public function autoAddLinks(){
				$linkCon = new LinksController();
				$linkCon->autoAddLink();	
					return $this->adminlinksPage();		
				
		}

		public function addadminlinks(){
				
			$type = Input::get('auto');		
			if(!empty($type))
			{

				return $this->autoAddLinks();
			}		
			
			return $this->manualAddLinks();

		}
		public function addlinkloc(){

			
			$country = Input::get('country');

		LinkLoc::insert([
			'country' => $country
			]);

		return $this->linklocPage();


		}
		public function deleteLoc(){

			
			$ID = Input::get('ID');

			LinkLoc::where('ID' , $ID)->delete();


			return $this->linklocPage();

		}			
		function deleteLink(){

			$ID = Input::get('ID');
			Links::where('ID',$ID)->delete();

		}




}

?>