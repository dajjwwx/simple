<?php
class GaokaoMenu extends CWidget
{
	private $baseUrl;
	
	
	public $view = 'courses';	//year
	
	public $courses;
	public $provinces;
	public $years;
	
	public function init()
	{
		$this->courses = $this->getCourses();	
		
		$this->provinces = Region::model()->generateProvince(0);		
	
		$this->years = $this->getYears();
	}
	
	public function getYears()
	{
		$years = array_reverse(range(2006,date('Y')));
		
		return $years;
	}
	
	private function getCourses()
	{
		$config =  Yii::getPathOfAlias('gaokao.config.courses').'.php';		
		$this->courses = require_once $config;		
		return $this->courses;
	}
	
   /**
    * Publishes the assets
    */
   public function publishAssets()
   {
      $dir = dirname(__FILE__).DIRECTORY_SEPARATOR.'assets';
 
      $this->baseUrl = Yii::app()->getAssetManager()->publish($dir);
   }
   
      /**
    * Registers the external javascript files
    */
   public function registerClientScripts()
   {
      if ($this->baseUrl === '')
         throw new CException('Can not find the base folder');

       Yii::app()->getClientScript()->registerCssFile($this->baseUrl.'/style.css');
   }
	
	public function run()
	{		
		$this->publishAssets();
		$this->registerClientScripts();
	
		$this->render($this->view,array(
			'courses'=>$this->courses,
			'provinces'=>$this->provinces,
			'years'=>$this->years
		));
	}
}
?>