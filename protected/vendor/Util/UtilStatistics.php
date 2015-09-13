<?php
class UtilStatistics
{
    public static function hitAdd($model, $column)
    {
  		//自动增加点击量
		$model->$column++;
		//		$model->save();
//		$key = Yii::app()->user->getStateKeyPrefix().Yii::app()->request->getUserHostAddress().Yii::app()->user->name.$model->category->cate_id.$model->arc_id;
// 		echo $key."<br />";
        
        $key = Yii::app()->request->getUrl();
        
//        echo $key;

		$key = md5($key);
		$session = Yii::app()->session;
        
//        unset($session[$key]);

		if(!isset($session[$key])){
				
			//Visitors::model()->addArticleVisitorInfo($model->$column);
			
			if($model->save()){
				$session[$key] = md5(time());
			}			
		}
    }
}
?>