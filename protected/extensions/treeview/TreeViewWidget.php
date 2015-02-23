<?php
class TreeViewWidget extends CWidget
{
	public $clientScript;
	
	public $baseUrl;
	public $Jscripts = array('jquery.treeview.js','jquery.treeview.async.js');
	public $Cssscript = array('jquery.treeview.css');	
	public $id = 'treeview';
    public $needCore = false;
    
    public $treeview = Category::TREE_VIEW_LINK;
    public $link = 'space/list';
    public $type = Category::CATEGORY_BOOKS;
    public $htmlOptions = array(
    	'id'=>'treeview'
    );
    
	private $_options = array(

    );	//'width': '75%','height': '75%','autoScale':false,


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
   			
   		$("#{$this->id}").treeview({$option});
   		
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
		$this->render('treeview');	
	}
	
	
}
?>