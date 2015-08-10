<?php
/* @var $this CoursePaperController */
/* @var $model CoursePaper */

$this->breadcrumbs=array(
	'Course Papers'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List CoursePaper', 'url'=>array('index')),
	array('label'=>'Manage CoursePaper', 'url'=>array('admin')),
);
?>
<div class="panel panel-default">
	<div class="panel-heading"><h4><span class="glyphicon glyphicon-plus"></span> Create CoursePaper</h4></div>
	<div class="panel-body">
		<?php $this->renderPartial('_form', array('model'=>$model)); ?>	</div>
</div>



