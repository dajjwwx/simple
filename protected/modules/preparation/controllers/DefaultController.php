<?php

class DefaultController extends Controller
{
	public $layout = '//layouts/preparation';

	public function actionIndex()
	{
		$this->render('index');
	}


	public function actionInsert()
	{
		// $model = Catalog::model()->
		// 
		$lines = file('./public/data2.txt');

		// UtilHelper::dump($lines);

		foreach($lines as $line)
		{

			$data = preg_split("/[\s]+/", $line);

			// foreach($keywords as $data)
			// {
				if(!Catalog::model()->exists('name = :name',array(':name'=>$data[2]))){
					$model = new Catalog();

					$model->id = $data[0];
					$model->pid = $data[1];
					$model->name = $data[2];
					$model->course = 2;

					if($model->validate() && $model->save())
					{
						UtilHelper::dump($model->attributes);
					}
					else
					{
						UtilHelper::dump($model->errors);
					}					
				}
				else
				{
					echo "已经存在";
				}



			// }



		}
	}
}