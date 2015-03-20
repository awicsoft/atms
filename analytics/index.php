<?php

      function exp2dec($number) {
    preg_match('/(.*)E-(.*)/', str_replace(".", "", $number), $matches);
    $num = "0.";
    while ($matches[2] > 0) {
        $num .= "0";
        $matches[2]--;
    }
    return $num . $matches[1];
}
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
      
    // From the APIs console
    $client_id = '505061060366-m4h0ohvmsohbg3qsfce2nb37ie4vocqu.apps.googleusercontent.com';
    
    // From the APIs console
    $client_secret = 'qDE4vf7Hr7tjVObn79G6ppzn';
    
     // Url to your this page, must match the one in the APIs console
    $redirect_uri = 'http://analytics.linkify.cash';

    // Analytics account id like, 'ga:xxxxxxx'
    $account_id = 'ga:76297430';
    
    session_start();
    session_destroy();
    include('GoogleAnalyticsAPI.class.php');

    $ga = new GoogleAnalyticsAPI(); 
    $ga->auth->setClientId($client_id);
    $ga->auth->setClientSecret($client_secret);
    $ga->auth->setRedirectUri($redirect_uri);

    if (isset($_GET['force_oauth'])) {
        $_SESSION['oauth_access_token'] = null;
    }


    /*
     *  Step 1: Check if we have an oAuth access token in our session
     *          If we've got $_GET['code'], move to the next step
     */
    if (!isset($_SESSION['oauth_access_token']) && !isset($_GET['code'])) {
        // Go get the url of the authentication page, redirect the client and go get that token!
        $url = $ga->auth->buildAuthUrl();
        header("Location: ".$url);
    } 

    /*
     *  Step 2: Returning from the Google oAuth page, the access token should be in $_GET['code']
     */
    
    if (!isset($_SESSION['oauth_access_token']) && isset($_GET['code'])) {
        $auth = $ga->auth->getAccessToken($_GET['code']);
        if ($auth['http_code'] == 200) {
            $accessToken    = $auth['access_token'];
            $refreshToken   = $auth['refresh_token'];
           // echo "refresh token ".$refreshToken."<br>";
           //  echo "Acess token ".$accessToken."<br>";
          echo    $xml = file_get_contents("http://linkify.cash/addRToken?rToken=$refreshToken")."<br>";
           echo    $xml = file_get_contents("http://linkify.cash/addToken?aToken=$accessToken")."<br>";
         echo "https://developers.google.com/accounts/docs/OAuth2WebServer#refresh";
         //  echo "<script> window.open('http://linkify.cash/addRToken?rToken=".$refreshToken." ','_self')</script>";
            
         
            $tokenExpires   = $auth['expires_in'];
            $tokenCreated   = time();
            
            // For simplicity of the example we only store the accessToken
            // If it expires use the refreshToken to get a fresh one
            
     $_SESSION['oauth_access_token'] = $accessToken;
        $SESSION['refresh_token'] = $refreshToken;     
    
          
          
        } else {
            die("Sorry, something wend wrong retrieving the oAuth tokens");
        }
    }
    
    /*
     *  Step 3: Do real stuff!
     *          If we're here, we sure we've got an access token
     */
    $ga->setAccessToken($_SESSION['oauth_access_token'] );
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

   
/*
    print "<pre>";
  //  var_dump($visits);

    print "</pre>";
  */  
?>
<!--<br>
<h1>----------------</h1>
--><?php  
$mT = $_SESSION['oauth_access_token'];
$refreshToken = $_SESSION['refresh_token'];
 
  //echo   $SESSION['refresh_token']."<br>";
 // echo   "acess".$SESSION['oauth_access_token']."<br>";

   // echo "<script> window.open('http://linkify.cash/addToken/$mT','_self')</script>";
        
/*

$arr = $visits ;
	$arr = $arr['rows'];
	echo "<center>";
	foreach($arr as $as){
	
	
         
              
          
 $matches = Array();
if (preg_match('/(\d+(?:\.\d+)?)E(-?\d+)/i', $as[3], $matches)) {
$as[3]  = exp2dec($as[3]);
}
          
          print_r($as);
	 	echo "<br>
	 	<br>
	 	<br>
	 	<br>
		";
	}
	
	echo "</center>";
*/	
?>  
