<?php
class DataController extends CController
{
	public function actionIndex()
	{
		header('Content-type:text/html;charset=utf-8');
		
		$data = array();
		
		$dom = new DOMDocument();
		
		 $dom->load('./public/data.xml');	
		 
		 $items = $dom->getElementsByTagName('ul');		 
		 $i = $k = 0;		 		 
		 foreach ($items as $item)
		 {
		 	$li = $items->item($i)->getElementsByTagName('li');
		 	
		 	$k = 0;
		 	foreach ($li as $params)
		 	{
		 		$_item = $li->item($k)->getElementsByTagName('h4')->item(0)->nodeValue;
// 		 		echo $_item.'<br />';
		 		
		 		
		 		$_item_box = $li->item($k)->getElementsByTagName('div')->item(0)->getElementsByTagName('a');
		 		
		 		$j = 0;
		 		foreach ($_item_box as $_item_content)
		 		{
// 		 			echo "--".$_item_box->item($j)->nodeValue;
		 			
		 			$data[$_item][] = $_item_box->item($j)->nodeValue;
		 			
		 			$j++;
		 		}
// 		 		echo "<br />";		 		
		 		
		 		$k++;
// 		 		echo "<br />";
		 	}
		 	$i++;
		 	
		 }
		 	/******************************************************************
		 	 * *********************************************************************
		 	 */		 	
		 	
		 	foreach ($data as $key=>$value)
		 	{
		 		echo $key.'<br />';	 		
		 		
		 		$model = Category::model()->findByAttributes(array('name'=>$key));
// 		 		UtilHelper::dump($model->attributes);
		 		
		 		
		 		if (!$model) {
		 			$model = new Category();		 			
		 			$model->name = $key;	
		 			$model->pid = 0;
		 			$model->weight = rand(0, 100);
		 			$model->type = Category::CATEGORY_BOOKS;	
		 			$model->description = '关于"'.$key.'"';			
		 			if(!$model->save())
		 			{	 				
		 				UtilHelper::dump($model->errors);
		 			}
		 			else 
		 			{
		 				UtilHelper::dump(__LINE__);
		 				UtilHelper::dump($model->attributes);
		 			}
		 		}
		 			
		 		foreach ($value as $val)
		 		{
		 			$model2 = Category::model()->findByAttributes(array('name'=>$val));
		 			$model2->pid = $model->id;
		 			$model2->name = $val;
		 			$model2->weight = rand(0, 100);
		 			$model2->type = Category::CATEGORY_BOOKS;
		 			$model2->description = '关于"'.$val.'"';
		 			UtilHelper::dump(__LINE__);
		 			UtilHelper::dump($model->attributes);
		 			
		 			
		 			if(!$model2->save())
		 			{
		 				UtilHelper::dump($model2->errors);
		 			}		 				
		 		}
		 		
		 		
		 	} 	
		 UtilHelper::dump($data); 
		
	}


}
?>