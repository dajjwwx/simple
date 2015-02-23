<?php

class DefaultController extends Controller
{
	public $layout = '//layouts/books';
	
	public function actionTest()
	{
		$models = Books::model()->findAll();
		
		UtilHelper::dump($models);
	}
	
	public function actionIndex()
	{
		
		$hotbooks = Books::model()->recentUpdates(8);
		
		$this->render('index',array(
			'hotbooks'=>$hotbooks
		));		
	}
	
	public function actionAddBooks($isbn)
	{
		
// 		UtilHelper::dump($_GET);
		
// 		echo $isbn;
		
		$factory = BookFactory::book('douban',$isbn);
		
		UtilHelper::dump($factory->getImage());
		
// 		echo $factory->getTags();
		
// 		UtilHelper::dump($factory);
		
		die();
		

		
		$url = "https://api.douban.com/v2/book/isbn/:".$isbn;
		
		$info =  file_get_contents($url);
		
		$bookinfo =json_decode($info);
		
		echo $bookinfo->subtitle;
		
		// 		$this->render('index',array(
		// 			'bookinfo'=>$bookinfo
		// 		));
		
		UtilHelper::dump($bookinfo);
		
		die();
		
		$model = Books::model()->findAll();
		
		UtilHelper::dump($model);
		
		
	}
}