<?php
class BlogLatest extends CWidget
{
	public $bloglist = array();
	public $htmlOptions = array();
	public $limit = 5;
	public $view = 'blog';
	public $length = 15;
	public function run()
	{
	
		$bloglist = Blog::model()->findAll('status =:status ORDER BY pubdate DESC LIMIT :limit',array(':status'=>Blog::STATUS_PUBLISHED,':limit'=>$this->limit));

		$this->render($this->view, array(
			'list'=>$bloglist
		));
	}
}
?>