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

	

	public function actionAddProvince()
	{
		$provinces = Province::model()->findAll();

		// UtilHelper::dump($provinces);

		// die();

		foreach ($provinces as $key => $province) {
			UtilHelper::dump($province->attributes);
			$region = new Region();
			$region->region = $province->name;
			$region->pid = 0;
			$region->code = $province->code;
			$region->uid = Yii::app()->user->id;

			// UtilHelper::dump($region->attributes);

			if($region->validate() && $region->save()){
				echo $region->id;
			}
			else
			{
				UtilHelper::dump($region->errors);
			}
		}
	}


	public function actionAddCity()
	{
		set_time_limit(18000) ;

		$cities = City::model()->findAll();

		$i = 0;

		foreach ($cities as $key => $city) {
			// UtilHelper::dump($city->attributes);

			$model = Region::model()->find(array(
				'condition'=>'region = :region AND code = :code',
				'params'=>array(
					':region'=>$city->name,
					':code'=>$city->code
				)
			));

			if(!$model)
			{

				$province = Region::model()->find(
					array(
						'condition'=>'code = :code',
						'params'=>array(
							':code'=>$city->provincecode
						)
					)
				);

				$pid = $province->id;

				UtilHelper::dump($province->attributes);


				$region = new Region();
				$region->region = $city->name;
				$region->pid = $pid;
				$region->code = $city->code;
				$region->uid = Yii::app()->user->id;

				if($region->save()){
					echo $region->id;
				}

				$i = $i + 1;
				echo $i;
			}
			else
			{
				echo "已经存在";
				UtilHelper::dump($model->attributes);
			}
		}
	}

	public function actionAddArea()
	{
		set_time_limit(18000) ;

		$cities = Area::model()->findAll();

		$i = 0;

		foreach ($cities as $key => $city) {
			UtilHelper::dump($city->attributes);

			$model = Region::model()->find(array(
				'condition'=>'region = :region AND code = :code',
				'params'=>array(
					':region'=>$city->name,
					':code'=>$city->code
				)
			));

			if(!$model)
			{

				$province = Region::model()->find(
					array(
						'condition'=>'code = :code',
						'params'=>array(
							':code'=>$city->citycode
						)
					)
				);

				$pid = $province->id;



				UtilHelper::dump($province->attributes);


				$region = new Region();
				$region->region = $city->name;
				$region->pid = $pid;
				$region->code = $city->code;
				$region->uid = Yii::app()->user->id;

				if($region->save()){
					echo $region->id;
				}

				$i = $i + 1;
				echo $i;

			}
			else
			{
				echo "已经存在";
				UtilHelper::dump($model->attributes);
			}


		}
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