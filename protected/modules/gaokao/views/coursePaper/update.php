<?php
/* @var $this CoursePaperController */
/* @var $model CoursePaper */

$this->breadcrumbs=array(
	'Course Papers'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List CoursePaper', 'url'=>array('index')),
	array('label'=>'Create CoursePaper', 'url'=>array('create')),
	array('label'=>'View CoursePaper', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage CoursePaper', 'url'=>array('admin')),
);
?>

<div class="panel panel-default">
	<div class="panel-heading"><h4><span class="glyphicon glyphicon-pencil"></span> Update CoursePaper <?php echo $model->id; ?></div>
	<div class="panel-body">
		<?php $this->renderPartial('_form', array('model'=>$model)); ?>	</div>
<div>