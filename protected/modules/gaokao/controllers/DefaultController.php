<?php

class DefaultController extends Controller
{
	
	public $layout='//layouts/gaokao';
	
	public function actionIndex()
	{
		$courses = Gaokao::model()->getCourses();
		$provinces = Gaokao::model()->getProvinces();
		
		$this->render('index',array(
			'courses'=>$courses,
			'provinces'=>$provinces
		));
	}


	public function actionRPC()
	{

		Yii::import('ext.hprose.*');
		require_once("Hprose.php");
		// require_once('Hprose.')
		
		UtilHelper::dump(get_included_files());

		// die();

	    $client = new HproseHttpClient('http://uustudio.sinaapp.com/Service/segment.php');
	    echo $client->hello('World');

	}
	

	public function actionTest()
	{
		$link = Gaokao::model()->getPaperLink(22,1,2013);

		echo $link;
	}
}