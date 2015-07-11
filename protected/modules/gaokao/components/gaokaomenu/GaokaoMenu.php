<?php
class GaokaoMenu extends CWidget
{
	
	public $view = 'courses';	//year
	
	public $courses;
	public $provinces;
	
	public function init()
	{
		$this->courses = $this->getCourses();	
		
		$this->provinces = Region::model()->generateProvince(0);	
		
	}
	
	private function getCourses()
	{
		$config =  Yii::getPathOfAlias('gaokao.config.courses').'.php';		
		$this->courses = require_once $config;		
		return $this->courses;
	}
	
	public function run()
	{		
		$this->render($this->view,array(
			'courses'=>$this->courses,
			'provinces'=>$this->provinces
		));
	}
}
?>