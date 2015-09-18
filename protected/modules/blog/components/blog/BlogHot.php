<?php
class BlogHot extends CWidget
{
	public $bloglist = array();
	public $htmlOptions = array();
	public $limit = 5;
	public $view = 'blog';
	public $length = 15;
	public function run()
	{
	
		$bloglist = Article::model()->findAll('arc_state =:arc_state ORDER BY arc_hits DESC LIMIT :limit',array(':arc_state'=>Article::STATUS_PUBLISHED,':limit'=>$this->limit));

		$this->render($this->view, array(
			'list'=>$bloglist
		));
	}
}
?>