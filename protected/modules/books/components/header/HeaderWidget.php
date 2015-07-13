<?php
class HeaderWidget extends CWidget
{
	public $view = 'index';
	
	public function getAction()
	{
		return Yii::app()->getController()->getAction()->id;
	}
	
	public function getImage() 
	{		
		$id = isset($_GET['id'])?intval($_GET['id']):1;
		
		if ($this->getAction() == 'view') 
		{
			$image = BookShelfInfo::model()->getBookShelfFolderByBookId($id, 120);
			$shelf = Books::model()->findByPk($_GET['id'])->shelf;
		}
		elseif($this->getAction() == 'home') 
		{
			$image = BookShelfInfo::model()->getBookShelfFolder($id, 120);
			$shelf = BookShelf::model()->findByPk(intval($_GET['id']));
		}
		
		return $image;
	}
	
	public function getShelf()
	{
		
		$id = isset($_GET['id'])?intval($_GET['id']):1;
		
		if ($this->getAction() == 'view') 
		{
			$shelf = Books::model()->findByPk($id)->shelf;
		}
		elseif($this->getAction() == 'home') 
		{
			$shelf = BookShelf::model()->findByPk($id);
		}
		
		return $shelf;
	}
	
	public function run() 
	{
		$this->render('header', array(
			'image'=>$this->getImage(),
			'shelf'=>$this->getShelf()
		));
	}
}
?>