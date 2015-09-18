<?php

class ShelfController extends Controller
{
	
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/books';

	// Uncomment the following methods and override them if needed
	/*
	public function actions()
	{
	// return external action classes, e.g.:
	return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
					'class'=>'path.to.AnotherActionClass',
					'propertyName'=>'propertyValue',
			),
	);
	}
	*/
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
						'actions'=>array('index','view','home','recent'),
						'users'=>array('*'),
				),
				array('allow', // allow authenticated user to perform 'create' and 'update' actions
						'actions'=>array('create','update','uploadshelf'),
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
		$dataProvider=new CActiveDataProvider('BookShelf');
		$this->render('index',array(
				'dataProvider'=>$dataProvider,
		));
	}
	
	public function actionRecent()
	{
		$criteria = new CDbCriteria(array(
				'order'=>'id DESC',
		));		
		$dataProvider=new CActiveDataProvider('Books',array(
				'criteria'=>$criteria,
				'pagination'=>array(
						'pageSize'=>24,
				),
		));
		
		$this->render('recent',array(
				'dataProvider'=>$dataProvider
		));
	}
	
	public function actionHome($id)
	{
		$data = BookShelf::model()->findByPk($id);
	
		$criteria = new CDbCriteria(array(
				'condition'=>'sid = :sid',
				'params'=>array(
						':sid'=>$id
				)
		));
		
		//写入书店信息
		$model = BookShelfInfo::model()->updateShelfInfo($id);	
		//封面所有展示图
		$list = BookShelfInfo::model()->getFolderList($data->id);
	
		$dataProvider=new CActiveDataProvider('Books',array(
				'criteria'=>$criteria,
				'pagination'=>array(
					'pageSize'=>12		
				)
		));
		$this->render('home',array(
				'data'=>$data,
				'list'=>$list,
				'dataProvider'=>$dataProvider,
		));	
	}
	
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		
		$model = $this->loadBookModel($id);
		
		$criteria = new CDbCriteria(array(
			'condition'=>'bid = :bid AND id != :id',
			'params'=>array(
				':bid'=>$model->bid,
				':id'=>$id		
			)	
		));
		
		$dataProvider=new CActiveDataProvider('Books',array(
				'criteria'=>$criteria,
				'pagination'=>array(
						'pageSize'=>12
				)
		));
		
		$this->render('view',array(
				'model'=>$model,
				'dataProvider'=>$dataProvider,
		));
	}
	
	
	
	
	/**
	 * 显示个人书库主页
	 * @param integer $id
	 */
// 	public function actionHome($id)
// 	{
		
// 		$data = BookShelf::model()->findByPk($id);
		
// 		$criteria = new CDbCriteria(array(
// 				'condition'=>'sid = :sid',
// 				'params'=>array(
// 					':sid'=>$id		
// 				)
// 		));
		
// 		$dataProvider=new CActiveDataProvider('Books',array(
// 				'criteria'=>$criteria
// 		));
// 		$this->render('home',array(
// 				'data'=>$data,
// 				'dataProvider'=>$dataProvider,
// 		));
// 	}
	
	/**
	 * 上传相片
	 */
	public function actionUploadShelf()
	{
		if(Yii::app()->user->isGuest) throw new CHttpException(403,'bad');
		if (!empty($_FILES)) {
			$folder = Yii::app()->params['uploadBooksPath'];
			$fileext = $_REQUEST['fileext'];			
			$pid = $_REQUEST['id'];
			UtilUploader2::uploadNormal('Filedata',File::FILE_TYPE_BOOKS,Yii::app()->params['uploadBooksPath'],$pid);
			
			$album = File::model()->find(array(
					'condition'=>'filetype = :filetype AND pid = :pid',
					'order'=>'id DESC',
					'params'=>array(
						':filetype'=>File::FILE_TYPE_BOOKS,
						':pid'=>$pid		
					)
			));			
			$model = BookShelfInfo::model()->updateShelfInfo($pid);		
		}
		
		UtilHelper::writeToFile($_GET);
	}
	
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new BookShelf();

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		UtilHelper::dump($_POST);
		
		if(isset($_POST['BookShelf']))
		{
			$model->attributes=$_POST['BookShelf'];
			
			UtilHelper::dump($_POST);
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}
	
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Books the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=BookShelf::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	
	public function loadBookModel($id)
	{
		$model=Books::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	
}