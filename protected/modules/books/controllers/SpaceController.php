<?php

class SpaceController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/books';

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
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','addbooks','mybookshelf','cshelf','ushelf','dshelf','home','bookcategory'),
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
	
	public function actionBookCategory()
	{
		$this->layout = '//layouts/blank';
		
		$model = self::loadModel($_GET['id']);
	
		$this->performAjaxValidation($model);
		
		$this->render('book_category', array(
			'model'=>$model
		));
	}
	
	public function actionMyBookShelf()
	{
		$criteria = new CDbCriteria(array(
				'condition'=>'owner = :owner',
				'params'=>array(
						':owner'=>Yii::app()->user->id
				)
		));
		
		$dataProvider=new CActiveDataProvider('BookShelf',array(
				'criteria'=>$criteria
		));
		
		$this->render('mybookshelf',array(
				'dataProvider'=>$dataProvider,
		));
	}
	
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCShelf()
	{
		$model=new BookShelf();
	
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
	
		UtilHelper::dump($_POST);
	
		if(isset($_POST['BookShelf']))
		{
			$model->attributes=$_POST['BookShelf'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}
	
		$this->render('cshelf',array(
				'model'=>$model,
		));
	}
	
	public function actionUShelf($id)
	{
		$model=BookShelf::model()->findByPk($id);
	
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);	
	
		if(isset($_POST['BookShelf']))
		{
			$model->attributes=$_POST['BookShelf'];			
			if($model->save())
			{
				echo "bookshelf update success";
			}
			else 
			{
				UtilHelper::dump($model->errors());
			}
		}
		
		if (isset($_POST['BookShelfInfo'])) 
		{			
			$info = BookShelfInfo::model()->find(array(
					'condition'=>'sid = :sid',
					'params'=>array(
						':sid'=>$id		
					)	
			));	
			
			$info->attributes = $_POST['BookShelfInfo'];	
			
			if (isset($_POST['BookShelfInfo']['introduce'])) {
				$info->introduce = $_POST['BookShelfInfo']['introduce'];
			}		
			
// 		UtilHelper::dump($info->attributes);	
		
			if ($info->save())
			 {
				echo "bookshelfinfo update success";
			}
			else 
			{
				UtilHelper::dump($info->errors());
			}
		}

	}
	
	/**
	 * 编辑个人书库主页
	 * @param integer $id
	 */
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
				'criteria'=>$criteria
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
		
		$model = $this->loadModel($id);
		
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

	public function actionAddBooks()
	{	

		if (isset($_GET['isbn13'])) {

			$isbn = $_GET['isbn13'];			

			$model = new BookInfo();
			$info = $model->addBookInfo($_GET['isbn13']);
			
			$bid = $info->id;
			$sid = $_GET['id'];
			
			Books::model()->updateBook($sid, $bid);
			
// 			UtilHelper::dump($info->attributes);
			
			Yii::app()->end();
		}
		
		/**************************************
		 * 获取最近更新书目
		 */
		$criteria = new CDbCriteria(array(
				'condition'=>'sid = :sid',
				'order'=>'id DESC',
				'params'=>array(
						':sid'=>$_GET['id']
				),
					
		));
		$dataProvider=new CActiveDataProvider('Books',array(
				'criteria'=>$criteria,
				'pagination'=>array(
						'pageSize'=>8,
				),
		));
		
		$this->render('addbooks2',array(
				'dataProvider'=>$dataProvider
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Books;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Books']))
		{
			$model->attributes=$_POST['Books'];
			if($model->save())
			{				
				$this->redirect(array('home','id'=>$model->id));
			}
				
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

		if(isset($_POST['Books']))
		{
			$model->attributes=$_POST['Books'];
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
		$dataProvider=new CActiveDataProvider('Books',array(
				'pagination'=>array(
						'pageSize'=>16
				)
		));
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new BookInfo('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Books']))
			$model->attributes=$_GET['Books'];

		$this->render('admin',array(
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
		$model=Books::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Books $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='books-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
