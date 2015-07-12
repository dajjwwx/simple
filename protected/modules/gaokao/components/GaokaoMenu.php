<?php
class GaokaoMenu extends CWidget
{
	
	public $view = 'courses';	//year
	
	public $courses;
	
	public function init()
	{
		$this->courses = $this->getCourses();
		
		//UtilHelper::dump($this->courses);
	}
	
	private function getCourses()
	{
		$config =  Yii::getPathOfAlias($name.'.config.'.$item).'.php';		
		$this->courses = require_once $config;
		
		
		return json_decode(json_encode($this->courses));
	}
	
	public function run()
	{
		$this->render($this->view);		
	}
}