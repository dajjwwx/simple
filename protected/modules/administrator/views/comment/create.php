<?php
/* @var $this CommentController */
/* @var $model Comment */

$this->breadcrumbs=array(
	'Comments'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Comment', 'url'=>array('index')),
	array('label'=>'Manage Comment', 'url'=>array('admin')),
);
?>
<div class="panel panel-default">
	<div class="panel-heading"><h4><span class="glyphicon glyphicon-plus"></span> Create Comment</h4></div>
	<div class="panel-body">
		<?php $this->renderPartial('_form', array('model'=>$model)); ?>	</div>
</div>



