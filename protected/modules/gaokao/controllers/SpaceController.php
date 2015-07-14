<?php

class SpaceController extends Controller
{
	public $layout='//layouts/gaokao';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view','list'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('addpaper','upload'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	
	public function actionIndex()
	{
		$this->render('index');
	}	
		
	public function actionList()
	{
		$this->render('list');
	}	
	
	public function actionAddPaper()
	{
		$this->render('addpaper');
	}
	
	/**
	 *@used 上传试题
	 */
	public function actionUpload()
	{
		if(Yii::app()->user->isGuest) throw new CHttpException(403,'bad');		
		if (!empty($_FILES)) {			
			$folder = Yii::app()->params['uploadGaoKaoPath'];
			$fileext = $_REQUEST['fileext'];
			$pid = $_REQUEST['id'];
			UtilUploader2::uploadNormal('Filedata',File::FILE_TYPE_AVATAR,Yii::app()->params['uploadGaoKaoPath'],$pid);
		}		
	}
}