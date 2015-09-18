<?php
/**
 *@use 
 */
class JqueryUploadWidget extends CWidget
{
	public $clientScript;
	
	public $baseUrl;
	public $Jscripts = array('jquery.uploadfile.js');
	public $Cssscript = array('jquery.uploadfile.css');	
	public $id = 'facybox';
    public $needCore = false;
    
	private $_options = array(
		sizeErrorStr=>'只能10M'
    );


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
    
      if($this->needCore)
        $this->clientScript->registerCoreScript('jquery');
      
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
   			
   		$("#{$this->id}").uploadFile({$option});
   		
SCRIPT;
		Yii::app()->getClientScript()->registerScript('ext-box-jqueryupload',$script,CClientScript::POS_READY);
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
        
        $this->setBaseOptions();
        
		$this->registerScript();
//		$this->render('fancybox');	
	}
	
	
}
?>