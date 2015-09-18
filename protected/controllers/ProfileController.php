<?php

class ProfileController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/profile';

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
				'actions'=>array('index','view','regioninfo'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','info','favor','uploadavatar','avatars','avatar','regionaddress','regionhomeaddress','tags'),
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
		$model=new Profile;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Profile']))
		{
			$model->attributes=$_POST['Profile'];
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
	public function actionInfo($id)
	{
		$model=$this->loadModel($id);
		
		$favor = $this->loadFavorModel($id);
	
		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);
	
		if(isset($_POST['Profile']))
		{
			
			UtilHelper::writeToFile($_POST);
			$model->attributes=$_POST['Profile'];
			if($model->save())
				$this->redirect(array('info','id'=>$model->id));
		}
	
		$this->render('info',array(
				'model'=>$model,
				'favor'=>$favor
		));
	}
	
	/**
	 * 上传相片
	 */
	public function actionUploadAvatar()
	{	
		if(Yii::app()->user->isGuest) throw new CHttpException(403,'bad');		
		if (!empty($_FILES)) {			
			$folder = Yii::app()->params['uploadAvatarPath'];
			$fileext = $_REQUEST['fileext'];
			$pid = $_REQUEST['id'];
			UtilUploader2::uploadNormal('Filedata',File::FILE_TYPE_AVATAR,Yii::app()->params['uploadAvatarPath'],$pid);
		}
	}
	
	/**
	 * 生成用户头像
	 */
	public function actionAvatar()
	{
		if (Yii::app()->request->isPostRequest)
		{
			UtilHelper::writeToFile($_POST,'w+',__LINE__,__FILE__);
			
			if (!intval($_POST['modelID']))
			{
				echo "请先上传或选择要剪切的头像图片";
				Yii::app()->end();
			}	
		
			$user = User::model()->findByPk(Yii::app()->user->id);
				
			$profile = $user->profiles;
			$profile->avatar = $_POST['modelID'];
			$profile->save();
				
			$model = $profile->avatarModel;
					
// 			$model = File::model()->findByPk(intval($_POST['modelID']));
				
			$targ_w = $targ_h = 150;
			$jpeg_quality = 90;
				
			$desinfo = array(
					'width'=>150,
					'height'=>150,
					'path'=>File::model()->attributeAdapter($model)->getFilePath(Yii::app()->params['uploadAvatarPath'],true,true,array('width'=>150)),
			) ;
			
			$src = File::model()->attributeAdapter($model)->getFilePath(Yii::app()->params['uploadAvatarPath'],true,false);	
			
// 			$src_img = imagecreatefromjpeg($src);			
			
// 			$width = $height = 200;
// 			$scale = imagesx($src_img)/565;
			
	
			$src_w =isset($_POST['w'])?intval($_POST['w']):301;
			$src_h = isset($_POST["h"])?intval($_POST['h']):301;
			$src_x = isset($_POST['x'])?intval($_POST['x']):31;
			$src_y = isset($_POST['y'])?intval($_POST['y']):91;			

			
			$t = new UtilThumbHandle($src);
			

			
			// 			$des_img = imagecreatetruecolor($width, $height);
			// 			imagecolorallocate($des_img, $red=255, $green=255, $blue=255);
			
			$scale = $t->getSrcImgWidth()/565;
				
			$params = array(
// 					'dst_image'=>$des_img,
// 					'src_image'=>$src_img,
					'dst_x'=>0,
					'dst_y'=>0,
					'src_x'=>intval($src_x*$scale),
					'src_y'=>intval($src_y*$scale),
					'dst_w'=>200,
					'dst_h'=>200,
					'src_w'=>intval($src_w*$scale),
					'src_h'=>intval($src_h*$scale),
			);
			
			UtilHelper::writeToFile($params,'a+',__LINE__,__FILE__);
			extract($params);
			
			$t->createImg($desinfo, $src_x, $src_y, $src_w, $src_h);
			
			echo File::model()->attributeAdapter($model)->getFilePath(Yii::app()->params['uploadAvatarPath'],false,true,array('width'=>150,'onlyPath'=>true));
			
// 			File::model()->attributeAdapter($model)->generateAvatarPath(Yii::app()->params['uploadAvatarPath'],false,true,array('width'=>60));
// 			File::model()->attributeAdapter($model)->generateAvatarPath(Yii::app()->params['uploadAvatarPath'],false,true,array('width'=>30));

		}
		else
		{
			UtilHelper::commonWord();
		}
	}
	
	public function actionAvatars($id)
	{
		$result = array();
// 		$model = $this->loadModel($id);

		
		$model = File::model()->findAll(array(
				'condition'=>'owner = :uid AND filetype = :type',
				'params'=>array(
						':uid'=>$id,
						':type'=>File::FILE_TYPE_AVATAR
				)
		));
		
		foreach ($model as $avatar)
		{
			$result[] = array(
					'id'=>$avatar->id,
					'src'=>File::model()->attributeAdapter($avatar)->getFilePath(Yii::app()->params['uploadAvatarPath'],false,true,array('width'=>120))
			);
		}		
		echo json_encode($result);
	}
	
	/*
	 * ******************************************************
	 * Region
	 * *************************************************
	 */
	public function actionRegionInfo($id)
	{
		echo Region::model()->generateRegionLinks($id, '/profile/regioninfo',array('onclick'=>'eaddress($(this));return false;'),false);
	}
	
	/**
	 * 此方法用于修改用户个人的基本资料
	 */
	public function actionRegionAddress()
	{
		$this->layout = '//layouts/blank';
	
		$model = self::loadModel(Yii::app()->user->id);
	
		$this->performAjaxValidation($model);
	
		$this->render('address_current',array(
				'model'=>$model
		));
	
	
	}
	/**
	 * 此方法用于修改用户个人的基本资料
	 */
	public function actionRegionHomeAddress()
	{
		$this->layout = '//layouts/blank';
	
		$model = self::loadModel(Yii::app()->user->id);
	
		$this->performAjaxValidation($model);
	
		$this->render('address_home',array(
				'model'=>$model
		));	
	
	}
	
	/**
	 * 
	 * @param int $id
	 * @throws CHttpException
	 */
	public function actionTags()
	{
		$this->layout = '//layouts/blank';
		if (!isset($_GET['type']))
			throw new CHttpException(404,Yii::t('basic','The requested page does not exist.'));
			
		$type = $_GET['type'];
		if (isset($_GET['limit']))
			$limit = $_GET['limit'];
		else
			$limit = 10;
	
		if (isset($_GET['offset']))
			$offset = $_GET['offset'];
		else
			$offset = 0;
			
		echo Tag::model()->getTags($type, $limit, $offset, array('onclick'=>'showTips($(this));return false;'));
	}
	
	public function actionFavor($id)
	{
		$model = $this->loadFavorModel($id);
		
		UtilHelper::writeToFile($_POST,'a+',__LINE__,__FILE__,'./public/favor.txt');
		
		UtilHelper::dump($_POST);
		
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		
		if(isset($_POST['Favor']))
		{
			$model->attributes=$_POST['Favor'];
			if($model->validate()&&$model->save())
			{
				$url = $this->createUrl('info',array('id'=>$id,'#'=>'favor'));
				
				$this->redirect($url);
			}
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

		if(isset($_POST['Profile']))
		{
			$model->attributes=$_POST['Profile'];
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
		$dataProvider=new CActiveDataProvider('Profile');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Profile('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Profile']))
			$model->attributes=$_GET['Profile'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Profile the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Profile::model()->find(array(
				'condition'=>'uid = :uid',
				'params'=>array(
						':uid'=>$id
				)
		));
// 		$user = User::model()->findByPk($id);
// 		$model = $user->profiles;
		
		if($model===null)
		{
			$model = new Profile();
			$model->uid = Yii::app()->user->id;
			$model->save();
		}
			
		return $model;
	}
	
	public function loadFavorModel($id)
	{
		$model=Favor::model()->findByAttributes(array('uid'=>$id));
		if($model===null)
		{
			$model = new Favor();
			$model->uid = $id;
			$model->save();
		}
			
		return $model;
		
	}

	/**
	 * Performs the AJAX validation.
	 * @param Profile $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='profile-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
