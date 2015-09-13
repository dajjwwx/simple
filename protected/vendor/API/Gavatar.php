<?php

class Gavatar {
	
	
	public static function getAvatar($passport, $alt='', $htmlOptions=array()){
		
		$url = 'http://0.gravatar.com/avatar/'.md5($passport).'.jpg';
		
		return CHtml::image($url,$alt,$htmlOptions);
		
		

		
	}
	
}

?>