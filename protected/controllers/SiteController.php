<?php

class SiteController extends Controller
{
	
	public $layout = '//layouts/main';
	
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	public function actionTest()
	{

		$t = new Qiniu();

		$file = File::model()->find();

		$model = File::model()->attributeAdapter($file, Yii::app()->params->uploadGaoKaoPath);

		echo $t->getKey($model);

		// UtilHelper::dump($t);

	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		$this->layout = '//layouts/main';
		$this->render('index');
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];	
			
			if($model->validate())
			{
				$message = new Email();
				$message->name = $model->name;
				$message->email = $model->email;
				$message->subject = $model->subject;
				$message->body = $model->body;
				
				if ($message->validate() && $message->save()) {
					UtilMail::sendMail(Yii::app()->params['email'], $model->subject, $model->body);				
					Yii::app()->user->setFlash('contact',Yii::t('basic', 'Thank you for contacting us. We will respond to you as soon as possible.'));
				}
				else 
				{
					UtilHelper::writeToFile($message->errors);
				}


				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}
	
	//用户注册
	public function actionRegister()
	{
		$model=new RegisterForm;
	
		// uncomment the following code to enable ajax-based validation
		/*
		 if(isset($_POST['ajax']) && $_POST['ajax']==='register-form')
		 {
		echo CActiveForm::validate($model);
		Yii::app()->end();
		}
		*/
	
		if(isset($_POST['RegisterForm']))
		{
			$model->attributes=$_POST['RegisterForm'];
			if($model->validate())
			{
				$user = $model->register();
				
				if ($user) {
					Yii::app()->user->setFlash('state',Yii::t('basic', 'Thank you for parting in out club. you can login in your email to active your account now !'));
				}else {
					UtilHelper::dump($user->errors);
				}
				
				$this->refresh();
				
				
				// form inputs are valid, do something here
				return;
			}
		}
		$this->render('register',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
}