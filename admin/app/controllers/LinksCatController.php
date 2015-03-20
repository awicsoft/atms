<?php

class LinksCatController extends BaseController{



	public function fetchCat(){
		return $xml = file_get_contents("http://laughterburst.com/gag/wp-content/getCat.php");


	}


	public function getArrayOfCat(){
		$arr = [];

		 $string = $this->fetchCat();

		
		 $token = strtok($string, ",");
		

		while ($token !== false)
		{
			
			array_push($arr, $token);
			$token = strtok(",");
		} 

		$arr2 = [];
		for($i=0;$i<count($arr)-1;$i++){
			array_push($arr2, $arr[$i]);

		}
		return $arr2;

	}

	public function isAvailable($title){
		$cat = LinkCategory::where('title' ,$title);
		if($cat->count())
			return 1;
		return 0;

	}
	public function Store(){

		$catArr = $this->getArrayOfCat();
		
		foreach($catArr as $cat){


			if(!$this->isAvailable($cat)){
				LinkCategory::insert(['title' => $cat]);
				
			}

		}



	}

}