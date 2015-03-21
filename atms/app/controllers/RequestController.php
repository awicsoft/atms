<?php

class RequestController extends BaseController{

function post($url,$data){
        
        $r = new HttpRequest($url, HttpRequest::METH_POST);
        $r->setOptions(array('cookies' => array('lang' => 'de')));
        $r->addPostFields($data);
       // $r->addPostFile('image', 'profile.jpg', 'image/jpeg');
       
        try {
               return $r->send()->getBody();
           
             } catch (HttpException $ex) {
                   echo $ex;
                   return 'null';
              }

  }
  
}

?> 