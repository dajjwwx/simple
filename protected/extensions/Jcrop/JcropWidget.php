<?php
class JcropWidget extends CWidget
{
	public $clientScript;
	
	public $baseUrl;
	public $Jscripts = array('jquery.Jcrop.js');
	public $Cssscript = array('jquery.Jcrop.css','style.css');
	

	public $options;	//'width': '75%','height': '75%','autoScale':false,
    
    public $tar_width = 565;
    public $pre_width = 180;


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
      
      foreach ($this->Jscripts as $script)
      {
       $this->clientScript->registerScriptFile($this->baseUrl.'/js/'.$script,CClientScript::POS_HEAD);     	
      }
            
      foreach ($this->Cssscript as $css)
      {
      	$this->clientScript->registerCssFile($this->baseUrl.'/css/'.$css);
      }
   }
   
   public function registerScript()
   {
   		$path = $this->baseUrl;
        
        $head = <<<HEAD
        
function JcropAction(){
        		
    var jcrop_api,
        boundx,
        boundy,

        // Grab some information about the preview pane
        preview = $('#preview-pane'),
        pcnt = $('#preview-pane .preview-container'),
        pimg = $('#preview-pane .preview-container img'),

        xsize = pcnt.width(),
        ysize = pcnt.height();
    
     initJcrop();
        		
    console.log('init',[xsize,ysize]);
    
    
    function initJcrop(){
	    $('#target').Jcrop({
	      onChange: updatePreview,
	      onSelect: updatePreview,
	      aspectRatio: xsize / ysize
	    },function(){
	      // Use the API to get the real image size
	      var bounds = this.getBounds();
	      boundx = bounds[0];
	      boundy = bounds[1];
        		

	      // Store the API in the jcrop_api variable
	      jcrop_api = this;
	      
	      jcrop_api.setSelect(getRandom());
	
	      // Move the preview into the jcrop container for css positioning
	//       preview.appendTo(jcrop_api.ui.holder);
	    });
        
        alert(boundx);
	}
	
	function getRandom() {
      var dim = jcrop_api.getBounds();
      return [
        Math.round(Math.random() * dim[0]),
        Math.round(Math.random() * dim[1]),
        Math.round(Math.random() * dim[0]),
        Math.round(Math.random() * dim[1])
      ];
    }
        		
	// Our simple event handler, called from onChange and onSelect
	// event handlers, as per the Jcrop invocation above
	function showCoords(c) {
	    jQuery('#x').val(c.x);
	    jQuery('#y').val(c.y);
	    jQuery('#w').val(c.w);
	    jQuery('#h').val(c.h);
	};    
        		
	 /**
	 * coords是剪切时的图片参数
	 * coords.w : 剪切宽度
	 * coords.h : 剪切高度
	 */        		       		
    function updatePreview(c)
    {
      if (parseInt(c.w) > 0)
      {
        var rx = xsize / c.w;
        var ry = ysize / c.h;

        pimg.css({
          width: Math.round(rx * boundx) + 'px',
          height: Math.round(ry * boundy) + 'px',
          marginLeft: '-' + Math.round(rx * c.x) + 'px',
          marginTop: '-' + Math.round(ry * c.y) + 'px'
        });
      }
	  showCoords(c);
    };        		
}
        
HEAD;
		$script = <<<SCRIPT
		
			JcropAction();	
		
SCRIPT;

		Yii::app()->getClientScript()->registerScript($this->id.'head',$head,CClientScript::POS_BEGIN);
//         Yii::app()->getClientScript()->registerScript($this->id.'ready',$script,CClientScript::POS_READY);
   }
      
	public function run()
	{
		$this->publishAssets();
		$this->registerClientScripts();
		$this->registerScript();
//		$this->render('jcrop');	
	}

}
?>