<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/column1';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();	
	
	public  function registerScripts()
	{
		$scripts = array(
				'ykg'=>array(
						'core'=>array('core','form','dom','string','bootstrap'),
						'plugins'=>array('jquery.lazyload.js')
				)
		);
		
		foreach ($scripts as $libs=>$script){
			if ($libs == 'ykg') {
				foreach ($script as $dir=>$libs){
					if($dir == 'core'){
						foreach ($libs as $core){
							//Yii::app()->getClientScript()->registerScriptFile('http://www.simplecdn.com/YKG/1.1/core/yuekegu.'.$core.'.js',CClientScript::POS_HEAD);
							Yii::app()->getClientScript()->registerScriptFile('/public/js/YKG/1.1/core/yuekegu.'.$core.'.js',CClientScript::POS_HEAD);
						}
					}else{
						foreach ($libs as $plugin){
							//Yii::app()->getClientScript()->registerScriptFile('http://www.simplecdn.com/YKG/1.1/plugins/'.$plugin,CClientScript::POS_HEAD);
							Yii::app()->getClientScript()->registerScriptFile('/public/js/YKG/1.1/plugins/'.$plugin,CClientScript::POS_HEAD);
						}
					}
		
				}
			}
		}
	}
}