<?php
class HotShelvesWidget extends CWidget
{

	private $data = null;

	public function init()
	{
		$criteria = new CDbCriteria(array(
				'order'=>'id DESC',
				'condition'=>'owner = :owner',
				'params'=>array(
						':owner'=>Yii::app()->user->id
				)
		));

		$this->data=new CActiveDataProvider('BookShelf',array(
				'criteria'=>$criteria
		));

	}

	public function run()
	{
		$this->render('hotshelves',array(
				'data'=>$this->data

		));
	}

}