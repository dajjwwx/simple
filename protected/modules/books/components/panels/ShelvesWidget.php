<?php
class ShelvesWidget extends CWidget
{

	public $name = '畅读书籍';
	public $id = null;
	public $link = '/books/bookshelf/home';
	
	private $data = null;

	public function init()
	{
		$criteria = new CDbCriteria(array(
				'order'=>'id DESC',
		));
		
		if (!is_null($this->id)) {
			$criteria->addCondition('owner = '.$this->id);
		}

		$this->data=new CActiveDataProvider('BookShelf',array(
				'criteria'=>$criteria
		));

	}

	public function run()
	{
		$this->render('shelves',array(
				'data'=>$this->data

		));
	}

}