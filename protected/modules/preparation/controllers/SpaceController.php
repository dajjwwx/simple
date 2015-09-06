<?php

class SpaceController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/preparation';

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
				'actions'=>array('index','view','test','list','course'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','upload','chapterfiles','download'),
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

	public function actionTest()
	{
		$catalog = Catalog::model()->findAll(array(
			'condition'=>'course = 2'
		));

		$objects = Catalog::model()->dataAdapter($catalog);


		$category = new CategoryModel();
		// UtilHelper::dump($objects);

		$category->generateTree($objects);


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
	 *此处的实现可以更改为只使用File Model
	 * id 即为 Preparation 的cid也是File的pid
	 */
	public function actionChapterFiles($id,$owner = null)
	{
		$result = array();
		$i = 0;

		$criteria = new CDbCriteria(array(
			// 'join'=>'JOIN simplebase.sb_file on file.owner = '.Yii::app()->user->id,
			// 'join'=>'INNER JOIN simplebase.sb_file b on b.owner = '.Yii::app()->user->id,
			'condition'=>'cid = :cid',
			'params'=>array(
				':cid'=>$id,
			)
		));

		$model = Preparation::model()->findAll($criteria);

		$folder = Yii::app()->params->uploadPreparationPath;

		if($model)
		{

			foreach($model as $data)
			{		

				if($data->file->owner == $owner)
				{
					$result[$i] = array(
						'filename'=>$data->file->name,
						'catalog'=>$data->catalog->name,
						'id'=>$data->id,
						'path'=>File::model()->attributeAdapter($data->file)->getFilePath($folder,$false,$false)

					);

					$i++;
				}
				
				if($owner == null){
					$result[$i] = array(
						'filename'=>$data->file->name,
						'catalog'=>$data->catalog->name,
						'id'=>$data->id,
						'path'=>File::model()->attributeAdapter($data->file)->getFilePath($folder,$false,$false)

					);
					$i++;
				}
			}			
		}
		// else
		// {
		// 	$result['fail'] = true;
		// }


		echo json_encode($result);


	}


	/**
	 * 文件下载
	 */
	public function actionDownload($id)
	{
		$model = $this->loadModel($id);

		$folder = Yii::app()->params->uploadPreparationPath;

		$filename = File::model()->attributeAdapter($model->file)->getFilePath($folder, false, false);

		$file = fopen($filename,"r"); 


		$download = new UtilDownload('doc,docx,ppt,pptx,pdf',false);
		$download->setDownloadFilename($model->file->name);
		if (!$download->downloadfile($filename))
		{
			echo $download->geterrormsg();
		}
	}

	/**
	 *为方便浏览，只允许上传PDF,文件
	 ****************************************************
	 *@used 上传试题
	 */
	public function actionUpload()
	{
		if(Yii::app()->user->isGuest) throw new CHttpException(403,'bad');

		
		if (!empty($_FILES)) {			
			$folder = Yii::app()->params['uploadPreparationPath'];
			$fileext = $_REQUEST['fileext'];
			$pid = $_REQUEST['pid'];

			UtilHelper::writeToFile($_REQUEST);

			// UtilUploader2::uploadNormal('Filedata',File::FILE_TYPE_GAOKAO,Yii::app()->params['uploadGaoKaoPath'],$pid,'*.pdf');
			
			try{
				// $data = UtilUploader2::uploadQiniu('Filedata',File::FILE_TYPE_PREPARATION,$folder,$pid,'*.doc;*.ppt;*.docx;*.pptx;*.pdf');
				$data = UtilUploader2::uploadQiniu('Filedata', File::FILE_TYPE_PREPARATION, $folder, $pid, '*.doc;*.ppt;*.docx;*.pptx;*.pdf', $prefix='');
				echo $data;
			}catch(Exception $e){
				UtilHelper::writeToFile($e,'a+');
			}
			
		}

	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Preparation;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Preparation']))
		{
			$model->attributes=$_POST['Preparation'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
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

		if(isset($_POST['Preparation']))
		{
			$model->attributes=$_POST['Preparation'];
			if($model->save())
			{
				$breadcrumbs = Catalog::model()->generateBreadcrumbs($model->cid,$model->catalog->course); 
				$category = new CategoryModel(); 
				echo $category->generatePageTitle($breadcrumbs,true,' / ');

				Yii::app()->end();
				// $this->redirect(array('view','id'=>$model->id));
			}

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

	public function actionCourse($id)
	{
		$idsArray = array();
		$criteria = new CDbCriteria(array(
			'select'=>'id',
			'condition'=>'course = :course',
			'params'=>array(
				':course'=>$id
			)
		));

		$model = Catalog::model()->findAll($criteria);

		foreach ($model as $item) {
			$idsArray[] = $item->id;
		}

		if($idsArray)
		{
			$ids =  implode(',', $idsArray);

			$criteria = new CDbCriteria(array(
				'condition'=>'cid in ('.$ids.')',
			));

			// $models = Preparation::model()->findAll($criteria);
			$dataProvider=new CActiveDataProvider('Preparation',array(
				'criteria'=>$criteria
			));
		}
		else
		{
			throw new CHttpException(404,'The requested page does not exist.');
		}

		$this->render('course',array(
			'dataProvider'=>$dataProvider,
			'id'=>$id
		));		
	}

	public function actionList($id)
	{
		$result = array();

		$model = Catalog::model()->findbyPk($id);
		$idsArray = CategoryModel::getChildrenIds($model);
		$idsArray[] = $model->id;

		if($idsArray)
		{
			$ids =  implode(',', $idsArray);

			$criteria = new CDbCriteria(array(
				'condition'=>'cid in ('.$ids.')',
			));

			// $models = Preparation::model()->findAll($criteria);
			$dataProvider=new CActiveDataProvider('Preparation',array(
				'criteria'=>$criteria
			));
		}

		$this->render('list',array(
			'dataProvider'=>$dataProvider,
			'model'=>$model
		));

	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Preparation');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Preparation('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Preparation']))
			$model->attributes=$_GET['Preparation'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Preparation the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Preparation::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Preparation $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='preparation-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
