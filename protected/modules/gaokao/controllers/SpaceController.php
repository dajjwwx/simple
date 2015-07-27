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
				'actions'=>array('index','view','list','viewsingle','year'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('addpaper','upload','update'),
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

		
	public function actionList()
	{

		$courses = Gaokao::model()->getCourses();
		$provinces = Region::model()->generateProvince(0);
		$year = $_GET['year']?$_GET['id']:(date('Y')-1);


		$this->render('list',array(
			'courses'=>$courses,
			'provinces'=>$provinces,
			'year'=>$year
		));

	}

	public function actionYear()
	{

		$courses = Gaokao::model()->getCourses();
		$provinces = Region::model()->generateProvince(0);
		$year = $_GET['year']?$_GET['id']:(date('Y')-1);


		$this->render('list',array(
			'courses'=>$courses,
			'provinces'=>$provinces,
			'year'=>$year
		));
	}	
	
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}
	
	public function actionViewSingle()
	{
		$this->layout = '/layouts/blank';
		
		$this->render('view_single');
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionAddPaper()
	{
		$model=new Gaokao;

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['Gaokao']))
		{
			$model->attributes=$_POST['Gaokao'];
			if($model->save())
			{
				//$this->redirect(array('view','id'=>$model->id));
				echo json_encode($model->attributes);
			}
			
			return ;
		}

		$this->render('addpaper',array(
			'model'=>$model,
		));
	}
	
	/**
	 *为方便浏览，只允许上传PDF文件
	 ****************************************************
	 *@used 上传试题
	 */
	public function actionUpload()
	{
		if(Yii::app()->user->isGuest) throw new CHttpException(403,'bad');		
		if (!empty($_FILES)) {			
			$folder = Yii::app()->params['uploadGaoKaoPath'];
			$fileext = $_REQUEST['fileext'];
			$pid = $_REQUEST['id'];
			UtilUploader2::uploadNormal('Filedata',File::FILE_TYPE_GAOKAO,Yii::app()->params['uploadGaoKaoPath'],$pid,'*.pdf');
		}		
	}
	

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Gaokao']))
		{
			$model->attributes=$_POST['Gaokao'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Gaokao');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Gaokao('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Gaokao']))
			$model->attributes=$_GET['Gaokao'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Gaokao the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Gaokao::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Gaokao $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='gaokao-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}