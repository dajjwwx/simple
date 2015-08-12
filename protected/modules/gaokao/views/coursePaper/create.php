<?php
/* @var $this CoursepaperController */
/* @var $model Coursepaper */

$this->breadcrumbs=array(
	'Coursepapers'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Coursepaper', 'url'=>array('index')),
	array('label'=>'Manage Coursepaper', 'url'=>array('admin')),
);
?>

<h1>Create Coursepaper</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>