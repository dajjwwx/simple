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

	public function actionRegion()
	{
		$model = Area::model()->find(array(
			'condition'=>'name = \'会东县\''
		));

		UtilHelper::dump($model->attributes);
		UtilHelper::dump($model->city->attributes);

		echo '------------------------------';

		$city = City::model()->find(array(
			'condition'=>'code = :code',
			'params'=>array(
				':code'=>$model->citycode
			)
		));

		UtilHelper::dump($city->attributes);
		UtilHelper::dump($city->province->attributes);
	}

	public function actionTest()
	{
		$link = Gaokao::model()->getPaperLink(22,1,2013);

		echo $link;
	}
}