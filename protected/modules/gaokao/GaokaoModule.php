<?php

class GaokaoModule extends CWebModule
{
	public function init()
	{
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
		$this->setImport(array(
			'gaokao.models.*',
			'gaokao.components.*',
			'gaokao.models.*',
		));
	}	
		
	/**
	 * ********************************************************
	 * 此处重新实现不带参数的tranlate方法
	 * ***********************************************************
	 * @param string $category
	 * @param string $message
	 * @return Ambigous <string, string>
	 */
	public function t($category, $message)
	{
	
		$t = new CPhpMessageSource();
		$t->basePath = Yii::getPathOfAlias('gaokao.messages');
		return $t->translate($category, $message);
	
	}

	public function beforeControllerAction($controller, $action)
	{
		if(parent::beforeControllerAction($controller, $action))
		{
			// this method is called before any module controller action is performed
			// you may place customized code here
			return true;
		}
		else
			return false;
	}
}
