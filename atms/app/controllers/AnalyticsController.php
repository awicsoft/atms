<?php
require_once 'GoogleAnalyticsAPI.class.php';


class AnalyticsController extends BaseController {
var $client_id;
var $client_secret;
var  $redirect_uri;
var $account_id ;
var $oauth_access_token;

function intializing(){
 $this->client_id = '505061060366-m4h0ohvmsohbg3qsfce2nb37ie4vocqu.apps.googleusercontent.com';
    
    // From the APIs console
 $this->client_secret = 'qDE4vf7Hr7tjVObn79G6ppzn';
    
     // Url to your this page, must match the one in the APIs console
    $this->redirect_uri = 'http://linkify.cash/analytics';

    // Analytics account id like, 'ga:xxxxxxx'
    $this->account_id = 'ga:76297430';
    
    
}

    function exp2dec($number) {
    preg_match('/(.*)E-(.*)/', str_replace(".", "", $number), $matches);
    $num = "0.";
    while ($matches[2] > 0) {
        $num .= "0";
        $matches[2]--;
    }
    return $num . $matches[1];
}

function analytics(){
    
    try{
         return $this->result();     
    } catch (Exception $ex) {
    echo $ex;
  // return Redirect::to("http://analytics.linkify.cash");
        }
   
    
}
function getAcessTokenWithRefreshToken(){
    
      
    $refreshToken = Analytics::where('ID',1)->first()->rtoken;
    
      $this->intializing();
      
      $data = [
          'refresh_token' => $refreshToken,
          'client_id' => $this->client_id,
          'client_secret' =>$this->client_secret,
          'grant_type' => 'refresh_token'
              
              ];  
      
      $request = new RequestController();
      $data = $request->post("https://www.googleapis.com/oauth2/v3/token", $data);
      if( $data!=null){
        // var_dump($data);
       return  $data[3];
       
       
      }
      return $data;
     
}
function refreshAcessToken(){
      $token =  $this->getAcessTokenWithRefreshToken();
      if($token != null)
      {
          $this->oauth_access_token = $token;
          Analytics::where('ID',1)->update(['token' =>$token]);
      }else echo "error";
      
      
      
}
 function result()
{
         $this->intializing();
  
     $token = Analytics::where('ID',1)->first();
     $token = $token->token;
     $this->oauth_access_token = $token;
     
      
    // From the APIs console

    $ga = new GoogleAnalyticsAPI(); 
    $ga->auth->setClientId($this->client_id);
    $ga->auth->setClientSecret($this->client_secret);
    $ga->auth->setRedirectUri($this->redirect_uri);



    $ga->setAccessToken( $this->oauth_access_token);
    $ga->setAccountId($this->account_id);

    
    // Set the default params. For example the start/end dates and max-results
    $defaults = array(
        'start-date' => date('Y-m-d', strtotime('-1 day')),
        'end-date'   => date('Y-m-d')
       
    );
    $ga->setDefaultQueryParams($defaults);

    $params = array(

        'metrics'    => 'ga:visits,ga:adsenseRevenue',
        'dimensions' => 'ga:medium,ga:country',
        'max-results' => '100000',
        'start-date' => date('Y-m-d', strtotime('-1 day')),
        'end-date'   => date('Y-m-d'),
        'sort' => '-ga:visits'
    );
    
    $visits = $ga->query($params);

    
    if($visits['http_code'] == 200)
    echo "Sucessfully being fetching";
else{
    
  $this->refreshAcessToken();
  $this->result();
exit();    
}

  //print_r($visits);

$arr = $visits ;
	$arr = @$arr['rows'];
	echo "<center>";
          $date = date('Y-m-d');
         $share= ShareLink::where('date',$date)->get();
        foreach($share as $sh){
            
                ShareLink::where('ID' , $sh->ID)->update(['visits'=>0 , 'adsense' => 0]);
            
        }
        
	foreach($arr as $as){
	
	
         
              
          
 $matches = Array();
if (preg_match('/(\d+(?:\.\d+)?)E(-?\d+)/i', $as[3], $matches)) {
$as[3]  = $this->exp2dec($as[3]);
}
          
$user = User::where('username',$as[0]);
    if($user->count()){
            $user = $user->first();
            $userID = $user->ID;
            
      $location =   LinkLoc::where('country',$as[1]);
      if($location ->count() ){
          $location  = $location->first();
         $location_ID  = $location->ID;
          
      }
      else  
      $location_ID  = LinkLoc::where('country',"Other")->first()->ID;
       
      $visit = $as[2];
        $adsense = $as[3];
        $date = date('Y-m-d');
      $share= ShareLink::where('userID',$userID)->where('loc_ID',$location_ID)->where('date' , $date) ;
  $earning = 0;
      $earning = $this->calEarning($userID,$location_ID,$visit ,$adsense);
      
      
          if($share->count()){
               
	          if(!$location ->count() ){
	          	
                      $preVisits =  $share->first()->visits;
	          	 $visit += $preVisits;
	          $preAdsense =	$share->first()->adsense;
                  $adsense += $preAdsense;
	          }
          $share->update([
          'visits' => $visit , 
          'adsense' => $adsense,
          'earning' => $earning
          ]);
          }
      else{
        
        ShareLink::insert([
          'userID' => $userID , 
          'loc_ID' => $location_ID , 
          'visits' => $visit , 
          'adsense' => $adsense,
          'date' => $date,
          'earning' => $earning
          ]);
      }
    }    
/*    print_r($as);
	 	echo "<br>
	 	<br>
	 	<br>
	 	<br>
		";
*/	}
	

 
  }


 function calEarning($userID,$locationID,$visits,$adsense){
 	$earning = 0;
 	$user = User::where('ID',$userID)->first();
 	$categoryID = $user->category_ID;
 	
 	$CategoryTitle= UserCategory::where('ID',$categoryID)->first()->title;
 	
 	if($CategoryTitle == 'Adsense'){
 		$adsenseRate = AdsenseRate::where('ID',1)->first()->rate;
 		$earning = $adsense * ($adsenseRate/100);
 		return $earning;
 		
 	}else{
 	echo $categoryID;
 	
 		$rate = Rate::where('user_category_ID',$categoryID)->where('link_loc_ID',$locationID);
 		
 		if($rate->count())
 		{
 			$rate = $rate->first()->rate;
 		}
 		else $rate = 0;
 		 
 		$earning = $visits* ($rate);
 		return $earning;
 	
 	}
 	
 	
 	
 	
 }

}
  