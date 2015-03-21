<?php

class RequestController extends BaseController{

function post($url,$data){
        
    

// use key 'http' even if you send the request to https://...
$options = array(
    'http' => array(
        'header'  => "Content-type: application/x-www-form-urlencoded",
        'method'  => 'POST',
        'content' => http_build_query($data),
    ),
);
$context  = stream_context_create($options);
$result = file_get_contents($url, false, $context);
var_dump($result);
$data =  explode('"',$result);
if(is_array($data) && count($data) >3)
{   
    
    return $data;
}
else 
    return null;
        }
}

?> 