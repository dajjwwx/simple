<?php
/* @var $this SpaceController */
/* @var $model Books */

$this->breadcrumbs=array(
	'Books'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Books', 'url'=>array('index')),
	array('label'=>'Manage Books', 'url'=>array('admin')),
);
?>

	<?php $this->renderPartial('_form', array('model'=>$model)); ?>



