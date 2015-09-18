<?php
class RecentUpdatesWidget extends CWidget
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
						'pageSize'=>24,
				),
		));
	}
	
	public function run()
	{
		$this->render('recent_updates',array(
				'data'=>$this->data
				
		));
	}
	
}