<?php
/* @var $this CommentController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Comments',
);

$this->menu=array(
	array('label'=>'Create Comment', 'url'=>array('create')),
	array('label'=>'Manage Comment', 'url'=>array('admin')),
);
?>

<div class="panel panel-default">
	<div class="panel-heading">
		<h4><span class="glyphicon glyphicon-list"></span> Comments</h4>
	</div>
	<div class="panel-body">
	  <?php
	  	 $this->widget('application.components.comment.CommentWidget',array(
	  			'view'=>'list',
				'id'=>NULL,
				'type'=>Comment::COMMENT_TYPE_BLOG
	  	));
	 ?>	  	
	</div>
</div>