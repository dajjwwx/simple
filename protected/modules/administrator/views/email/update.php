<?php
/* @var $this EmailController */
/* @var $model Email */

$this->breadcrumbs=array(
	$this->module->t('admin','Feed Back')=>array('admin'),
	$model->name=>array('view','id'=>$model->id),
	$this->module->t('admin','Update'),
);

$this->menu=array(
	array('label'=>'List Email', 'url'=>array('index')),
	array('label'=>'Create Email', 'url'=>array('create')),
	array('label'=>'View Email', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Email', 'url'=>array('admin')),
);
?>

<h1><?php echo $this->module->t('admin','Update Message');?> #<?php echo $model->subject; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>