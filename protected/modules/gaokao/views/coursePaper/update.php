<?php
/* @var $this CoursepaperController */
/* @var $model Coursepaper */

$this->breadcrumbs=array(
	'Coursepapers'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Coursepaper', 'url'=>array('index')),
	array('label'=>'Create Coursepaper', 'url'=>array('create')),
	array('label'=>'View Coursepaper', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Coursepaper', 'url'=>array('admin')),
);
?>

<h1>Update Coursepaper <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>