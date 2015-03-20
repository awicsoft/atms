<?php
//usa
class AdminController extends UserController{



function isLogged() {
    parent::isLogged();
    return true;
    
}

	public function loginPage(){
			if(!$this->isLogged()){
				return View::make('userlogin');

			}
			return Redirect::intended('user/index');

	}

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
			if($this->isLogged()){
				$pre=0;
				$total=0;
				$categorys = LinkCategory::all();
				
				return View::make('linkcat',[
					'pre' => $pre,
					'total' => $total,
					'categorys'=>$categorys
					]);

			}

			return Redirect::intended('user/index');

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

public function userratesPage(){
		
		if($this->isLogged()){

			

			$categorys = UserCategory::all();
			
			$linkLoc = LinkLoc::all();	
			$rates = Rate::all();
			$rates = $this->rateiii($rates);
			
			$adsenseRate  = AdsenseRate::where('ID',1)->first()->rate;

				return View::make('userrates',['categorys' =>$categorys,'locations' =>$linkLoc, 'rates' => $rates,'adsenseRate' => $adsenseRate ]);

			}
			return Redirect::intended('user/logout');

		
	}
	public function userusercatPage(){
		
		if($this->isLogged()){

				$categorys = UserCategory::all();
			

				return View::make('userusercat',['categorys' =>$categorys]);

			}
			return Redirect::intended('user/logout');

		
	}
	function profile1($message){

		if($this->isLogged()){

				return View::make('userprofile',['message' => $message]);

			}
			return Redirect::intended('user/logout');


	}
	function sendNotificationPage(){


		if($this->isLogged()){
			$pre = 0;
			$userID = Input::get('userID');



			$total = 0;

			$notifications = Notification::all();
			return View::make('usernotification',['pre' =>$pre ,'total' =>$total,'notifications'=>$notifications,'userID'=>$userID]);
		}

			return Redirect::intended('user/logout');


	}
	function profilePage(){

		if($this->isLogged()){

				return View::make('userprofile');

			}
			return Redirect::intended('user/logout');


	}



	public function indexPage(){
		if($user = $this->isLogged()){

			return View::make('adminindex');

		}

		return Redirect::intended('user/logout');
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
		if($user = $this->isLogged()){
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

		return Redirect::intended('user/logout');


	}
	
	public function viewUserPage(){
		if($user = $this->isLogged()){
			$ID = Input::get('userID');
			$user = SUser::where('ID',$ID)->first();
			$address = Address::where('userID',$ID)->first();

			return View::make('userViewUser',['user'=>$user , 'address'=>$address]);
		

		}

		return Redirect::intended('user/logout');
	}

		
	


	


	function holduser(){
		if(!$this->isLogged()) 
			return "";
		$userID = Input::get('ID');
		$pre = Input::get('pre');
		SUser::where('ID',$userID)->update(['hold'=>1]);
			return $this->usersPage();
			return Redirect::to("user/users?pre=$pre");

	}
	function unholduser(){
			if(!$this->isLogged()) 
			return "";

		$userID = Input::get('ID');
		$pre = Input::get('pre');
		SUser::where('ID',$userID)->update(['hold' => 0]);
		return $this->usersPage();
		return Redirect::to("user/users?pre=$pre"); 

	}
	function enableuser(){
		if(!$this->isLogged()) 
			return "";
		$pre = Input::get('pre');


		$userID = Input::get('ID');

		SUser::where('ID',$userID)->update(['enable' => 1]);
			return $this->usersPage();
			return Redirect::to("user/users?pre=$pre");
	}
	function disableuser(){
		if(!$this->isLogged()) 
			return "";
		$pre = Input::get('pre');
		$userID = Input::get('ID');

		SUser::where('ID',$userID)->update(['enable' => 0]);
		return $this->usersPage();
		return Redirect::to("user/users?pre=$pre");
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

	function userusercat(){
			if(!$this->isLogged()) 
			return "";
		$title = Input::get('title');

			UserCategory::insert(['title' => $title]);

		return $this->userusercatPage();	

		
	}
	public function userrates(){
		if(!$this->isLogged()) 
			return "";

		$categoryID = Input::get('category');
		$loc_ID = Input::get('location');
		$rate = Input::get('rate');

		if(empty($loc_ID) ||empty($categoryID))
			return "ERROR : First add some locations or add some categories";

		Rate::insert(['user_category_ID' => $categoryID , 'link_loc_ID' => $loc_ID , 'rate' => $rate]);
		return $this->userratesPage();


	}
		public function addlinkcat(){
		if(!$this->isLogged()) 
			return "";

			$title = Input::get('title');

			LinkCategory::insert([
				'title' => $title

				]);
			return $this->linkcatPage();



		}
		public function deleteLinkCat(){
			if(!$this->isLogged()) 
						return "";
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

			return $this->userlinksPage();		
		}
		public function autoAddLinks(){
				$linkCon = new LinksController();
				$linkCon->autoAddLink();	
					return $this->userlinksPage();		
				
		}

		public function adduserlinks(){
						if(!$this->isLogged()) 
									return "";
			$type = Input::get('auto');		
			if(!empty($type))
			{

				return $this->autoAddLinks();
			}		
			
			return $this->manualAddLinks();

		}
		public function addlinkloc(){

			if(!$this->isLogged()) 
						return "";
			$country = Input::get('country');

		LinkLoc::insert([
			'country' => $country
			]);

		return $this->linklocPage();


		}
		public function deleteLoc(){

			if(!$this->isLogged()) 
						return "";

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
