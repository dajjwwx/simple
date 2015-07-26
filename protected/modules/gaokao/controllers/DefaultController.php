<?php

class DefaultController extends Controller
{
	
	public $layout='//layouts/gaokao';
	
	public function actionIndex()
	{
		$courses = Gaokao::model()->getCourses();
		$provinces = Region::model()->generateProvince(0);
		
		$this->render('index',array(
			'courses'=>$courses,
			'provinces'=>$provinces
		));
	}

	public function actionTest()
	{
		$link = Gaokao::model()->getPaperLink(9,1,2013);

		echo $link;
	}
}