<?php

class CoursePaperController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
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
				'actions'=>array('index','view','paper'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','province'),
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

	public function actionProvince($province, $year)
	{
		$this->layout = '/layouts/blank';

		$criteria = new CDbCriteria(array(
			'condition'=>'province = :province AND year = :year',
			'params'=>array(
				':province'=>$province,
				':year'=>$year
			)
		));

		$model = CoursePaper::model()->findAll($criteria);

		// if(!$model)
		// {

			$or = Gaokao::model()->provinceLike($province);

			$papercriteria = new CDbCriteria(array(
				'condition'=>'year = :year AND ('.$or.')',
				'params'=>array(
					':year'=>$year
				)
			));

			$paper = Paper::model()->find($papercriteria);

			// UtilHelper::dump($paper);
		// }

		$this->render('province',array(
			'model'=>$model,
			'paper'=>$paper
		));
	}


	public function actionPaper()
	{

		$this->layout = '/layouts/blank';

		$year = isset($_GET['year'])?$_GET['year']:date('Y');

		$model = Paper::model()->getPapers($year);

		$this->render('paper',array(
			'model'=>$model
		));


	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new CoursePaper;

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		$year = $_POST['CoursePaper']['year'];
		$province = $_POST['CoursePaper']['province'];
		$course = $_POST['CoursePaper']['course'];

		if(isset($_POST['CoursePaper']))
		{
			
			$model->attributes=$_POST['CoursePaper'];
			
			if(CoursePaper::model()->exists('year = :year AND province = :province AND course = :course',array(':year'=>$year,':province'=>$province,'course'=>$course)))
			{
				$result = array('status'=>'fail','message'=>'已经有了!');

			}
			else
			{				
				
				if($model->save())
				{
					$result = array('status'=>'success','message'=>'添加成功！');

				}
				else
				{
					$result = array('status'=>'fail','message'=>$model->errors);
				}
					
			}

			echo json_encode($result);

			return ;
		}



		$this->render('create',array(
			'model'=>$model,
		));
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

		if(isset($_POST['CoursePaper']))
		{
			$model->attributes=$_POST['CoursePaper'];
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
		$dataProvider=new CActiveDataProvider('CoursePaper');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new CoursePaper('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['CoursePaper']))
			$model->attributes=$_GET['CoursePaper'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return CoursePaper the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=CoursePaper::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CoursePaper $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='CoursePaper-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
