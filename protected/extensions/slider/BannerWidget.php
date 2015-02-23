<?php

/** 
 * @author Administrator
 * 
 */
class BannerWidget extends CWidget {
	
	public $baseUrl;
	public $Jscripts = array('unslider.min.js');
	public $Cssscript = array('style.css');
	
	public $data = array();
	
	private $cssFile;
	
	private $_options=array(
			
	);
	
	
	public function init()
	{
// 		$this->cssFile = Yii::app()->getAssetManager()->publish(Yii::getPathOfAlias('ext.slider.assets')).'/style.css';
	
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
	
		$this->clientScript = Yii::app()->getClientScript();
	
	
		foreach ($this->Jscripts as $script)
		{
			$this->clientScript->registerScriptFile($this->baseUrl.'/'.$script, CClientScript::POS_HEAD);
		}
	
		foreach( $this->Cssscript as $script)
		{
			$this->clientScript->registerCssFile($this->baseUrl.'/'.$script);
		}
	
	}
	
	public function registerScript()
	{
	
		$option =  CJavaScript::encode($this->_options);
	
	
		$script = <<<SCRIPT
	
$('.banner').unslider({
	speed: 500,               //  The speed to animate each slide (in milliseconds)
	delay: 3000,              //  The delay between slide animations (in milliseconds)
	complete: function() {},  //  A function that gets called after every slide animation
	keys: true,               //  Enable keyboard (left, right) arrow shortcuts
	dots: true,               //  Display dot navigation
	fluid: false              //  Support responsive design. May break non-responsive designs
});
   
SCRIPT;
	Yii::app()->getClientScript()->registerScript('ext-slider',$script,CClientScript::POS_READY);
   }
  
  
    protected function setBaseOptions(){
        $this->_options=array_merge(array(
     
        ),$this->_options);
	
    }
	
    /**
     * override defaults __get method to allow get options easier
     *
     * @param mixed $name
     * @return mixed
     */
    function __get($name){
        try{
            return parent::__get($name);
        }catch(exception $e){
            if(isset($this->_options[$name]))
                return $this->_options[$name];
            throw $e;
        }
    }
    /**
     * override defaults __set method to allow set options easier
     *
     * @param mixed $name
     * @param mixed $value
     * @return mixed
     */
    function __set($name,$value){
        try{
            return parent::__set($name,$value);
        }catch(exception $e){
            return $this->_options[$name]=$value;
        }
    }
	
	
	public function run()
	{
		$this->publishAssets();
		$this->registerClientScripts();
		$this->registerScript();
		$this->render('banner');
		
	}
	
}

?>