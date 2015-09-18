<?php 
/**
 * 使用方法
 */
 // $this->widget('ext.mdeditor.MdeditorWidget',array(
 //                'width' => "100%",
 //                'syncScrolling' => "single",
 //                'height'=> '740px',
 //                // 'theme' => "dark",
 //                // 'previewTheme' => "dark",
 //                // 'editorTheme' => "pastel-on-dark",
 //                'markdown' => null,
 //                'codeFold' => true,
 //                //'syncScrolling' => false,
 //                'saveHTMLToTextarea' => true,    // 保存 HTML 到 Textarea
 //                'searchReplace' => true,
 //                //'watch' => false,                // 关闭实时预览
 //                'htmlDecode' => "style,script,iframe|on*",            // 开启 HTML 标签解析，为了安全性，默认不开启    
 //                //'toolbar'  => false,             //关闭工具栏
 //                //'previewCodeHighlight' => false, // 关闭预览 HTML 的代码块高亮，默认开启
 //                'emoji' => true,
 //                'taskList' => true,
 //                'tocm'            => true,         // Using [TOCM]
 //                'tex' => true,                   // 开启科学公式TeX语言支持，默认关闭
 //                'flowChart' => true,             // 开启流程图支持，默认关闭
 //                'sequenceDiagram' => true,       // 开启时序/序列图支持，默认关闭,
 //                //'dialogLockScreen' => false,   // 设置弹出层对话框不锁屏，全局通用，默认为true
 //                //'dialogShowMask' => false,     // 设置弹出层对话框显示透明遮罩层，全局通用，默认为true
 //                //'dialogDraggable' => false,    // 设置弹出层对话框不可拖动，全局通用，默认为true
 //                //'dialogMaskOpacity' => 0.4,    // 设置透明遮罩层的透明度，全局通用，默认值为0.1
 //                //'dialogMaskBgColor' => "#000", // 设置透明遮罩层的背景颜色，全局通用，默认为#fff
 //                'imageUpload' => true,
 //                'imageFormats' => ["jpg", "jpeg", "gif", "png", "bmp", "webp"],
 //                'imageUploadURL' => "./php/upload.php",
 //                'onload' => function() {
 //                    // console.log('onload', this);
 //                    //this.fullscreen();
 //                    //this.unwatch();
 //                    //this.watch().fullscreen();

 //                    //this.setMarkdown("#PHP");
 //                    //this.width("100%");
 //                    //this.height(480);
 //                    //this.resize("100%", 640);
 //                }
	// ));
class MdeditorWidget extends CWidget
{

	public $baseUrl;
	public $Jscripts = array('editormd.min.js');
	public $Cssscript = array('editormd.css');
	
	public $data = array();
	public $id = 'mdeditor';
	
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
			$this->clientScript->registerCssFile($this->baseUrl.'/css/'.$script);
		}
	
	}
	
	public function registerScript()
	{
	
		
		$script = <<<SCRIPT
		    var {$this->id}; 

SCRIPT;

		Yii::app()->getClientScript()->registerScript('ext-mdeditor-1',$script,CClientScript::POS_HEAD);
		
		$option =  CJavaScript::encode($this->_options);
		$script = <<<SCRIPT
		    {$this->id} = editormd({$option});   

		    //{$this->id}.previewing();

SCRIPT;


	Yii::app()->getClientScript()->registerScript('ext-mdeditor',$script,CClientScript::POS_READY);
   }
  
  
    protected function setBaseOptions(){
        $this->_options=array_merge(array(
        			'id'=>$this->id,
                    'path' => $this->baseUrl."/lib/"                 
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
		
		$this->render('mdeditor',array(
			'id'=>$this->id
		));
		
	}
	
}

?>