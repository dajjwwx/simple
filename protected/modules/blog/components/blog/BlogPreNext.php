<?php
class BlogPreNext extends CWidget
{

	public $htmlOptions = array();

	public $length = 30;
	public $id;
	
	
	public function run()
	{	
		$this->render('prenext');
	}
}
?>