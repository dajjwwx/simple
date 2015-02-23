<?php
class HotBooksWidget extends CWidget
{
	
	private $data = null;
	
	public function init()
	{
		$criteria = new CDbCriteria(array(				
				'order'=>'id DESC',				
		));
		
		$this->data=new CActiveDataProvider('Books',array(
				'criteria'=>$criteria,
				'pagination'=>array(
						'pageSize'=>8,
				),
		));
	}
	
	public function run()
	{
		$this->render('hotbooks',array(
				'data'=>$this->data
				
		));
	}
	
}