<?php

class LinksController extends BaseController{





	public function fetch(){
		return $xml = file_get_contents("http://laughterburst.com/gag/wp-content/getLink.php");


	}


	public function allStoredLinks(){

		return Links::all();

	}


	public function getArrayOFLinks(){
		$arr = [];

		 $string = $this->fetch();

		
		 $token = strtok($string, "`");
		

		while ($token !== false)
		{
			


			array_push($arr, $token);
			$token = strtok("`");
		} 


	

		$arr2 = [];

		foreach ($arr as $dat) {

			 $postN = strtok($dat, ",");
			
			 $url =  strtok(",");
			  $title  = strtok(",");
			 $thumb = strtok(",");
			 $cat =  strtok(",");

			array_push($arr2,[
				'postNumber' => $postN,
				'title' => $title,
				'url' => $url,
				'thumb' => $thumb,
				'cat_name' => $cat 
				
				]);


		}
		$arr = $arr2;
		return $arr;


	}

	public function isAvailable($link_post_number){

		$link = Links::where('postNumber' , $link_post_number);
		
		if($link->count())
			return 1;
		
		return 0;

	}
	public function catNameToId($title){
		$cat = LinkCategory::where('title',$title)->first();
		if($cat!=NULL)
		return $cat->ID;
		else{
			$cat = LinkCategory::where('title',"Uncategorized")->first();
			return $cat->ID;
		}
	


	}
	public function store(){
		$arr = $this->getArrayOFLinks();


		foreach ($arr as $link) {
			$cat =$this->catNameToId($link['cat_name']);
			$title = $link['title'];
			$url = $link['url'];
			$thumb = $link['thumb'];
			$postNumber = $link['postNumber'];
			if(!$this->isAvailable($postNumber))
			Links::insert(['title'=>$title,'url' => $url,'thumb_url' =>$thumb ,'category_ID' =>$cat , 'postNumber'=>$postNumber]);
		}


	}
	public function autoAddLink(){
		set_time_limit ( 6000000 );
		$catCon = new LinksCatController();
		$catCon->Store();

		$this->store();

	}

	

}