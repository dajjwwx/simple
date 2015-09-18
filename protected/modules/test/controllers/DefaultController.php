<?php

class DefaultController extends Controller
{
	public function actionAdd()
	{
		echo ord('M')-(ord('A')-1);
	}
	
	public function actionAvatarPath()
	{
			$user = User::model()->findByPk(Yii::app()->user->id);
			
			$profile = $user->profiles;			
			$profile->avatar = 6;
			$profile->save();
			
			UtilHelper::dump($profile->attributes);
			
			$model = $profile->avatarModel;
			
			UtilHelper::dump($model->attributes);
			
			$path = File::model()->attributeAdapter($model)->getFilePath(Yii::app()->params['uploadAvatarPath'],true,false);
			
			echo $path;
	}
	
	public function actionUpload()
	{
		$_FILES = Array
		(
				'Filedata'=> Array
				(
						'name' => '初2014级教师合影.png',
						'type' => 'image/png',
						'tmp_name' => 'C:\Windows\Temp\phpF2CC.tmp',
						'error' => 0,
						'size' => 878567
				)
		
		);
		
		$folder = Yii::app()->params['uploadAvatarPath'];
		$fileext = $_REQUEST['fileext'];
		$pid = $_REQUEST['id'];
		UtilHelper::writeToFile($_FILES);
		
		
		$tempFile = $_FILES[$name]['tmp_name'];
		$fileext = explode( ';', $fileext);
		$result['Ext'] = $fileext;
		
		UtilHelper::writeToFile(__LINE__,'a+');
		UtilHelper::writeToFile($_FILES,'a+');
		
	
		//文件上传前的数据准备
		$dataArray = UtilUploader2::fileData('Filedata', $pid, '');
		$result['dataArray'] = $dataArray;
		
		UtilHelper::dump($result,'a+');
		
		$model = new File();
		$model->attributes = $dataArray;
		
		$file_links = 'links';
		$model->$file_links = $dataArray['links'];
		
		$result['Model'] = $model->attributes;
		
		$model = File::model()->findByPk(9);
		$file = new FileModel();
		$file->created = $model->created;
		$file->extension = 'jpg';
		$file->links = $model->name;
		
		echo $file->generateFilePath(Yii::app()->params['uploadAvatarPath'], $isUploadPath = false, $isThumb = true);
		
		
		$targetFile = File::model()->attributeAdapter($model)->getFilePath(Yii::app()->params['uploadAvatarPath'], true, false);
		$result['path']=$targetFile;
// 		UtilHelper::dump($result);
		
		

		
		
		
	}
	
	public function actionAvatar2()
	{
		if ($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			$user = User::model()->findByPk(Yii::app()->user->id);
			$model = $user->profiles->avatarModel;			
			
			$targ_w = $targ_h = 150;
			$jpeg_quality = 90;
			
			$desinfo = array(
					'width'=>180,
					'height'=>180,
					'path'=>File::model()->attributeAdapter($model)->getFilePath(Yii::app()->params['uploadAvatarPath'],true,true,array('width'=>180)),
			) ;
		
			$src = File::model()->attributeAdapter($model)->getFilePath(Yii::app()->params['uploadAvatarPath'],true,false);
			
			$img_r = imagecreatefromjpeg($src);
			$dst_r = ImageCreateTrueColor( $targ_w, $targ_h );
			
			$scale = imagesx($img_r)/565;
		
			imagecopyresampled($dst_r,$img_r,0,0,$_POST['x']*$scale,$_POST['y']*$scale,
			$targ_w,$targ_h,$_POST['w']*$scale,$_POST['h']*$scale);
		
			header('Content-type: image/jpeg');
			imagejpeg($dst_r,null,$jpeg_quality);
		
			exit;
		}
	}
	
	public function actionAvatar()
	{
		$user = User::model()->findByPk(Yii::app()->user->id);
		$model = $user->profiles->avatarModel;
		
		$src = File::model()->attributeAdapter($model)->getFilePath(Yii::app()->params['uploadAvatarPath'],true,false);
		$desinfo = array(
				'width'=>180,
				'height'=>180,
				'path'=>File::model()->attributeAdapter($model)->getFilePath(Yii::app()->params['uploadAvatarPath'],true,true,array('width'=>180)),
		) ;
		

		$t = new UtilThumbHandle($src);
// 		$t->createAvatar($desinfo);
// 		$t->createThumbnail($desinfo);

		$pos = array('x' =>$_POST['x'],		'y' => $_POST['y'],		'w' =>$_POST['w'],		'h' => $_POST['h']);
		extract($pos);
		
		UtilHelper::writeToFile($pos);

		$scale = $t->getSrcImgWidth()/565;

		$t->createImg($desinfo, $x*$scale, $y*$scale, $w*$scale, $h*$scale);
		
		UtilHelper::dump($src);
		UtilHelper::dump($desinfo);
		
		
	}
	
	public function actionFiles($aimDir='E:/www/')
	{
		
// 		$aimDir = dirname(Yii::getPathOfAlias('application'));
		
// 		$files = new Files();
// 		$files->content($_SERVER['DOCUMENT_ROOT']);
		
		$dirHandle = opendir($aimDir);
		while(false !== ($file = readdir($dirHandle))) {
			if ($file == '.' || $file == '..') {
				continue;
			}
			
			echo $file.'<br />';

		}
		
		
		UtilHelper::dump($files);

	}
	
public function actionMailTest() {
	
	// Import class
	Yii::import('ext.swiftMailer.SwiftMailer');
	// Create a new Transport object
// 	$Transport = SwiftMailer::smtpTransport($host, $port);
 
    // Render view and get content
    // Notice the last argument being `true` on render()
    $content = $this->render('mailTemplate', array(
        'test' => 'TestText 123',
    ), true);
 
    // Plain text content
    $plainTextContent = "This is my Plain Text Content for those with cheap emailclients ;-)\nThis is my second row of text";
 
    // Get mailer
    $SM = Yii::app()->swiftMailer;
 
    // Get config
    $mailHost = 'smtp.163.com';
    $mailPort = 25; // Optional
 
    // New transport
    $Transport = $SM->smtpTransport($mailHost, $mailPort);
 
    // Mailer
    $Mailer = $SM->mailer($Transport);
 
    // New message
    $Message = $SM
        ->newMessage('My subject')
        ->setFrom(array('dajjwwx@163.com' => 'Example Name'))
        ->setTo(array('zclandxy@gmail.com' => 'Recipient Name'))
        ->addPart($content, 'text/html')
        ->setBody($plainTextContent);
 
    // Send mail
    $result = $Mailer->send($Message);
    
    UtilHelper::dump($result);
}
	
	public function actionIndex()
	{
		echo chr('A');
		
		die();
		
		$result = array();
// 		$url = $_GET['url'];
		$url = 'http://v.youku.com/v_show/id_XMzc2NDU1MjU2.html?from=y1.3-edu-new-5132-10558.93251.1-3';
		
		$video = new CVideo();
		
		$detect = $video->ismedialine($url);
		if($detect['video'] == 1) {
			$result = $video->getvideo($url);
		} else {
			$result['message'] = "没有视频";
		}
		
		UtilHelper::dump($result);
		
		echo json_encode($result);
		
		$this->render('index');
	}
}