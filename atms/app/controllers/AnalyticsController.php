<?php
require_once 'GoogleAnalyticsAPI.class.php';
class AnalyticsController extends BaseController {
var $client_id;
var $client_secret;
var  $redirect_uri;
var $account_id ;
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
      $refreshToken = Analytics::where('ID',2)->first()->rtoken;
      $this->intializing();
      
      $date = [
          'refresh_token' => $refreshToken,
          'client_id' => $this->client_id,
          'client_secret' =>$this->client_secret,
          'grant_type' => 'refresh_token'
              
              ];  
      
      $request = new RequestController();
      $data = $request->post("https://www.googleapis.com/oauth2/v3/token", $data);
      if($date!='null')
        return $date['access_token'];
      
      return $date;
     
}
function refreshAcessToken(){
      $token =  $this->getAcessTokenWithRefreshToken();
      if($token != 'null')
         Analytics::where('ID',1)->update(['token' =>$token]);
      else echo "error";
}
 function result()
{
     $token = Analytics::where('ID',1)->first();
     $token = $token->token;
     
     Session::put('oauth_access_token', $token);
  
      
      
    /*
     * Basic usage example:
     *  - Redirect to the oAuth page if no access token is present
     *  - Handles the 'code' return from the oAuth page,
     *    fetches an access token save it in a session variable
     *  - Makes an API request using the access token in the session var
     *
     * Make sure to request your API-key first at: 
     *    https://console.developers.google.com
     */
      $this->intializing();
    // From the APIs console
  $client_id =  $this->client_id;
    
    // From the APIs console
  $client_secret =  $this->client_secret;
    
     // Url to your this page, must match the one in the APIs console
    $redirect_uri = $this->redirect_uri ;

    // Analytics account id like, 'ga:xxxxxxx'
    $account_id =  $this->account_id;
    
   
  //  include('GoogleAnalyticsAPI.class.php');

    $ga = new GoogleAnalyticsAPI(); 
    $ga->auth->setClientId($client_id);
    $ga->auth->setClientSecret($client_secret);
    $ga->auth->setRedirectUri($redirect_uri);

    if (Input::get('force_oauth')) {
         Session::put('oauth_access_token', null);
       
    }


    /*
     *  Step 1: Check if we have an oAuth access token in our session
     *          If we've got $_GET['code'], move to the next step
     */
    if (!Session::has('oauth_access_token')  && !Input::get('code')) {
        // Go get the url of the authentication page, redirect the client and go get that token!
        $url = $ga->auth->buildAuthUrl();
        header("Location: ".$url);
    } 

    /*
     *  Step 2: Returning from the Google oAuth page, the access token should be in $_GET['code']
     */
    
    if (!Session::has('oauth_access_token')  && Input::get('code')) {
        $auth = $ga->auth->getAccessToken(Input::get('code'));
        if ($auth['http_code'] == 200) {
            $accessToken    = $auth['access_token'];
            $refreshToken   = $auth['refresh_token'];
            $tokenExpires   = $auth['expires_in'];
            $tokenCreated   = time();
            
            // For simplicity of the example we only store the accessToken
            // If it expires use the refreshToken to get a fresh one
            
         
     Session::put('oauth_access_token',  $accessToken); 
     Analytics::where('ID',1)->update(['token' => $accessToken ]);      
     
          
        } else {
            die("Sorry, something wend wrong retrieving the oAuth tokens");
        }
    }
    
    /*
     *  Step 3: Do real stuff!
     *          If we're here, we sure we've got an access token
     */
    $ga->setAccessToken( Session::get('oauth_access_token'));
    $ga->setAccountId($account_id);

    
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

   

   // var_dump($visits);

?>
<?php  

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
  