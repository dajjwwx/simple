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

	}
	
	public function run()
	{
		$this->render($this->view);		
	}
}