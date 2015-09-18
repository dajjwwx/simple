<?php
class PreparationMenu extends CWidget
{
	private $baseUrl;
	
	public $view = 'courses';	//year
	
	public $courses;
	
	public function init()
	{
		$this->courses = $this->getCourses();	

	}

	
	private function getCourses()
	{

		$this->courses = Catalog::model()->getCourses();
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
		));
	}
}
?>
