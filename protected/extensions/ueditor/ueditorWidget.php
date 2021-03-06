<?php
class ueditorWidget extends CWidget
{
	public $clientScript;
	
	public $baseUrl;
	public $UEDITOR_HOME_URL = "/";
	public $js = array('ueditor.config.js','ueditor.all.js',);

	public $Cssscript = 'themes/default/css/ueditor.css';
	
	public $id = 'ueditor';
	public $editor = 'editor_a';
	public $_options = array();	//'width': '75%','height': '75%','autoScale':false,


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

//      $this->clientScript->registerCoreScript('jquery');
      
      foreach ($this->js as $src)
      {
      	$this->clientScript->registerScriptFile($this->baseUrl.'/'.$src,CClientScript::POS_HEAD);
      }

            
      $this->clientScript->registerCssFile($this->baseUrl.'/'.$this->Cssscript);
   }
   
   
    protected function setBaseOptions(){
        $this->_options=array_merge(array(
            'UEDITOR_HOME_URL'=> $this->baseUrl.$this->UEDITOR_HOME_URL,
        	'highlightJsUrl'=>$this->baseUrl.'/third-party/SyntaxHighlighter/shCore.js',
        	'highlightCssUrl'=>$this->baseUrl.'/third-party/SyntaxHighlighter/shCoreDefault.css',
// 			'imagePath' => Yii::app()->params['uploadEditorPath'], //$this->baseUrl.'/server/upload/' //'/public/uploadfiles/',
// 			'imagePathFormat'=>'/public/php/upload/{filename}'
        ),$this->_options);
        
   }
    
   public function registerScript()
   {

//    	var {$this->editor} = new UE.ui.Editor();
//    	{$this->editor}.render('{$this->id}');
   	
//    	{$this->editor}.ready(function(){
//    		{$this->editor}.setContent("欢迎使用Ueditor");
//    	});
   	
   		$options = CJavaScript::encode($this->_options);
   		
//    		var {$this->editor} = new baidu.editor.ui.Editor({$options});
//    		{$this->editor}.render('{$this->id}');

   		
   		$script = <<<SCRIPT
   		
   		
		 window.UEDITOR_HOME_URL = "{$this->baseUrl}/";
		 var ue = UE.getEditor('{$this->id}', {$options});
	     var domUtils = UE.dom.domUtils;
	
	     ue.addListener("ready", function () {
	         ue.focus(true);
	    });
    
SCRIPT;
		Yii::app()->getClientScript()->registerScript('ueditor',$script,CClientScript::POS_BEGIN);
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
///		$this->render('editor');	
	}

}
?>