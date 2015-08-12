<?php
/* @var $this CoursepaperController */
/* @var $model Coursepaper */

$this->breadcrumbs=array(
	'Coursepapers'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Coursepaper', 'url'=>array('index')),
	array('label'=>'Create Coursepaper', 'url'=>array('create')),
	array('label'=>'Update Coursepaper', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Coursepaper', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Coursepaper', 'url'=>array('admin')),
);
?>

<h1>View Coursepaper #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'province',
		'course',
		'paper',
		'year',
	),
)); ?>
