<?php

class CommentController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='/layouts/main';

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
				'actions'=>array('create','update','reply','trash','delete'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin'),
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

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Comment;

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['Comment']))
		{			
			$result = array(
					'status'=>'fail',
					'message'=>'不好意思，由于系统原因，您的评论没有成功~~',
			);
			
			$model->attributes=$_POST['Comment'];
			if($model->save())
			{
				$result = array(
						'status'=>'success',
						'message'=>'谢谢您的参与，我们将通过邮箱回复您的评论~~'				
				);
			}
			
			echo json_encode($result);
			
			Yii::app()->end();
			
		}
	}
	
	public function actionReply($id)
	{
		$comment = $this->loadModel($id);
		
		$model=new Comment;
		
		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);
		
		if(isset($_POST['Comment']))
		{
			$result = array(
					'status'=>'fail',
					'message'=>'不好意思，您的回复没有成功~~',
			);
				
			$model->attributes=$_POST['Comment'];
			
			UtilHelper::writeToFile($model->attributes);
			
			if($model->save())
			{
				$result = array(
						'status'=>'success',
						'message'=>'回复成功，已将回复发送至<em>'.$comment->author.'</em>的邮箱'
				);
			}
				
			echo json_encode($result);				
			Yii::app()->end();
				
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
		
		$result = array(
				'status'=>'fail',
				'message'=>'更新失败'
		);
		
		
		if ($model->status == Comment::COMMENT_PUBLISHED) {
			$model->status = Comment::COMMENT_LOCK;
			
			if ($model->save()) {
				$result = array(
						'status'=>'success',
						'message'=>'已取消审核！'
				);
			}			
		} elseif ($model->status == Comment::COMMENT_LOCK) {
			$model->status = Comment::COMMENT_PUBLISHED;
			if ($model->save()) {
				$result = array(
						'status'=>'success',
						'message'=>'已通过审核！'
				);
			}
		}
		
		echo json_encode($result);
		
		Yii::app()->end();
		


		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

// 		if(isset($_POST['Comment']))
// 		{
// 			$model->attributes=$_POST['Comment'];		
			
// 			if($model->save())
// 				$this->redirect(array('view','id'=>$model->id));
// 		}

// 		$this->render('update',array(
// 			'model'=>$model,
// 		));
	}
	public function actionTrash($id)
	{
		$model=$this->loadModel($id);
	
		$result = array(
				'status'=>'fail',
				'message'=>'更新失败'
		);	
		
		$model->status = Comment::COMMENT_TRASH;
		
		if ($model->save()) {
			$result = array(
					'status'=>'success',
					'message'=>'已标记删除！'
			);
		}
	
		echo json_encode($result);
	
		Yii::app()->end();
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
		$dataProvider=new CActiveDataProvider('Comment');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Comment('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Comment']))
			$model->attributes=$_GET['Comment'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Comment the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Comment::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Comment $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='comment-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
