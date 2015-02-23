<?php

class ImageController extends Controller
{
	public function actionIndex()
	{
		$this->render('index');
	}
	
	public function actionThumbnail()
	{
// 		$src = './public/upload/Avatar/2014/08/05/34cdf8a6038f748ab30040fef3de4b46.jpg';
// 		$des = './public/upload/Avatar/test.jpg';
		
// 		$user = User::model()->findByPk(Yii::app()->user->id);
// 		$model = $user->profiles->avatarModel;

// 		$_POST['modelID'] = 1;
		

		$model = File::model()->findByPk(intval($_POST['modelID']));
			
		$targ_w = $targ_h = 150;
		$jpeg_quality = 90;
			
		$desinfo = array(
				'width'=>160,
				'height'=>150,
				'path'=>File::model()->attributeAdapter($model)->getFilePath(Yii::app()->params['uploadAvatarPath'],true,true,array('width'=>150)),
		) ;		
		
		$src = File::model()->attributeAdapter($model)->getFilePath(Yii::app()->params['uploadAvatarPath'],true,false);	
		
		$src_img = imagecreatefromjpeg($src);			
		
		$scale = imagesx($src_img)/565;
		
		$src_w =isset($_POST['w'])?intval($_POST['w']):301;
		$src_h = isset($_POST["h"])?intval($_POST['h']):301;
		$src_x = isset($_POST['x'])?intval($_POST['x']):61;
		$src_y = isset($_POST['y'])?intval($_POST['y']):61;
					
		$des_img = imagecreatetruecolor($desinfo['width'], $desinfo['height']);
		imagecolorallocate($des_img, $red=255, $green=255, $blue=255);		
		
		$params = array(
			'dst_image'=>$des_img,
			'src_image'=>$src_img,
			'dst_x'=>0,
			'dst_y'=>0,
			'src_x'=>intval($src_x*$scale),
			'src_y'=>intval($src_y*$scale),
			'dst_w'=>200,
			'dst_h'=>200,
			'src_w'=>intval($src_w*$scale),
			'src_h'=>intval($src_h*$scale),				
		);		
		
		UtilHelper::writeToFile($params);
		extract($params);		
		
		$t = new UtilThumbHandle($src);
		
// 		$desinfo = array(
// 				'width'=>$dst_w,
// 				'height'=>$dst_h,
// 				'path'=>$des
// 		);
		
		$t->createImg($desinfo, $src_x, $src_y, $src_w, $src_h,2);
// 		imagecopyresampled( $this->h_dst, $this->h_src,$this->start_x, $this->start_y,$this->src_x, $this->src_y,$this->fill_w, $this->fill_h,$this->copy_w, $this->copy_h);
// 		imagecopyresampled($dst_image, $src_image, $dst_x, $dst_y, $src_x, $src_y, $dst_w, $dst_h, $src_w, $src_h);		
// 		header('Content-type: image/jpg');		
// // 		imagejpeg($des_img);		
// 		imagejpeg($des_img,$desinfo['path'],90);		
// 		imagedestroy($des_img);
// 		imagedestroy($src_img);
		
		Yii::app()->end();
	
	}
	
	
	public function actionPath()
	{
		$user = User::model()->findByPk(Yii::app()->user->id);
		$model = $user->profiles->avatarModel;

		$desinfo = array(
				'width'=>180,
				'height'=>180,
				'path'=>File::model()->attributeAdapter($model)->getFilePath(Yii::app()->params['uploadAvatarPath'],false,true,array('width'=>280,'onlyPath'=>false)),
		) ;
		
		UtilHelper::dump($desinfo);
	}
	
	public function actionCrop()
	{

		$src = './public/upload/Avatar/2014/08/05/34cdf8a6038f748ab30040fef3de4b46.jpg';
		$des = './public/upload/Avatar/test.jpg';
		
		$src_img = imagecreatefromjpeg($src);
		
		$width = $height = 200;
		$scale = imagesx($src_img)/565;
// 		$scale = 1;
		
		$des_img = imagecreatetruecolor($width, $height);
		imagecolorallocate($des_img, $red=255, $green=255, $blue=255);
		
		$src_x = 31;
		$src_y = 31;
		$src_w = 300;
		$src_h = 300;
		
		$params = array(
				'dst_image'=>$des_img,
				'src_image'=>$src_img,
				'dst_x'=>0,
				'dst_y'=>0,
				'src_x'=>$src_x*$scale,
				'src_y'=>$src_y*$scale,
				'dst_w'=>200,
				'dst_h'=>200,
				'src_w'=>$src_w*$scale,
				'src_h'=>$src_h*$scale,
		);
		
		extract($params);
		
		imagecopyresampled($dst_image, $src_image, $dst_x, $dst_y, $src_x, $src_y, $dst_w, $dst_h, $src_w, $src_h);
		
		header('Content-type: image/jpg');
		imagejpeg($des_img);
// 		imagejpeg($des_img,$des,90);
		imagedestroy($des_img);
		imagedestroy($src_img);
	}

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

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
}