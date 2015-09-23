<?php

class SpaceController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/blog';

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
				'actions'=>array('index','view','list','tags'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
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

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$this->layout = '//layouts/blog_editor';

		$model=new Blog;

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);		

		if(isset($_POST['Blog']))
		{			
			$model->attributes=$_POST['Blog'];
			if($model->save())
			{
				//把文章分类信息存在CID库				
				$ids = explode(',',$model->cids);
				foreach ($ids as $k=>$v)
				{
					$cids = new Cids();
					$cids->cid = $v;
					$cids->bid = $model->id;
					$cids->save();
				}
				
				//添加标签到标签库
				$tags = Tag::model()->string2array($model->tags);				
				Tag::model()->addTags($tags,Tag::TAG_BLOG);
				
				
				$str = 'Congratulation! have published you article, <span style="color:red">'.CHtml::link('write more',array('/blog/create')).' </span>, or<span style="color:red">'.CHtml::link('view the article', array('/blog/view','id'=>$model->id)).'</span>';
				//特别说明：因为在使用中文时不能正常使用Yii::app()->user->getFlash("success",$str);所以再次使用SESSION传值				
				Yii::app()->user->setFlash('success', $str);
				
				$this->redirect(array('view','id'=>$model->id));
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
		$this->layout = '//layouts/blog_editor';
		
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Blog']))
		{
			$model->attributes=$_POST['Blog'];
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
// 		$dataProvider=new CActiveDataProvider('Blog');
// 		$this->render('index',array(
// 			'dataProvider'=>$dataProvider,
// 		));
		
		$page = isset($_GET['page'])?$_GET['page']:0;
		$offset = 10;
		$num = $page*$offset;
		
		$criteria = new CDbCriteria(array(
				'condition'=>'status ='.Blog::STATUS_PUBLISHED,
				'order' => 'pubdate DESC',
				'limit'=>$num,
				'offset'=>$offset
		));
		 
		$count = Blog::model()->count($criteria);
		$pages = new CPagination($count);		
		
		$pages->pageSize = $offset;
		$pages->applyLimit($criteria);	 
		
		$models = Blog::model()->findAll($criteria);		
		
		$this->render('index',array(
				'models'=>$models,
				'pages'=>$pages
		));		
		
	}
	
	/**
	 * Lists all models.
	 */
	public function actionList()
	{
		// 		$dataProvider=new CActiveDataProvider('Blog');
		// 		$this->render('index',array(
		// 			'dataProvider'=>$dataProvider,
		// 		));
	
		$page = isset($_GET['page'])?$_GET['page']:0;
		$offset = 15;
		$num = $page*$offset;
		
		$id = intval($_GET['id']);
		
		$criteria = new CDbCriteria(array(
				'condition'=>"cids like '%,{$id}' OR cids like '%,{$id},' OR cids like '%{$id},' OR cids = '{$id}'",
				'order'=>'pubdate DESC',
				'limit'=>$num,
				'offset'=>$offset
		));
		
		$criteria->addCondition('status = '.Blog::STATUS_PUBLISHED);
			
		$count = Blog::model()->count($criteria);
		$pages = new CPagination($count);
			
		$pages->pageSize = $offset;
		$pages->applyLimit($criteria);
			
		$models = Blog::model()->findAll($criteria);
	
		$this->render('list',array(
				'models'=>$models,
				'pages'=>$pages
		));
	
	}
	

	public function actionTags()
	{
		$tag = urldecode($_GET['tag']);					
		if(!isset($tag))
			throw new CHttpException(404,'The requested page does not exist.');
		
		$page = isset($_GET['page'])?$_GET['page']:0;
		$offset = 15;
		$num = $page*$offset;		
		
		$criteria = new CDbCriteria(array(
				'order'=>'pubdate DESC',
				'limit'=>$num,
				'offset'=>$offset
		));
		
		$criteria->addSearchCondition('tags',$tag);
		$criteria->addCondition('status = '.Blog::STATUS_PUBLISHED);
			
		$count = Blog::model()->count($criteria);
		$pages = new CPagination($count);
			
		$pages->pageSize = $offset;
		$pages->applyLimit($criteria);
			
		$models = Blog::model()->findAll($criteria);
		
		$this->render('tags',array(
				'models'=>$models,
				'pages'=>$pages
		));

	}
	

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Blog('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Blog']))
			$model->attributes=$_GET['Blog'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Blog the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Blog::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Blog $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='blog-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
