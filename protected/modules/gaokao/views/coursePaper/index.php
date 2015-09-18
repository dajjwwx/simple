<?php
/* @var $this CoursepaperController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Coursepapers',
);

$this->menu=array(
	array('label'=>'Create Coursepaper', 'url'=>array('create')),
	array('label'=>'Manage Coursepaper', 'url'=>array('admin')),
);
?>

<h1>Coursepapers</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
