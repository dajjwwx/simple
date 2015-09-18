<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	$this->module->t('admin','User Management')=>array('admin'),
	$model->username=>array('view','id'=>$model->id),
	$this->module->t('admin','Update'),
);

$this->menu=array(
	array('label'=>'List User', 'url'=>array('index')),
	array('label'=>'Create User', 'url'=>array('create')),
	array('label'=>'View User', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage User', 'url'=>array('admin')),
);
?>

<div class="panel panel-default">
	<div class="panel-heading"><h4><span class="glyphicon glyphicon-pencil"></span> <?php echo $this->module->t('admin','Update User');?> #<?php echo $model->username; ?></h4></div>
	<div class="panel-body">
		<?php $this->renderPartial('_form', array('model'=>$model)); ?>
	</div>
</div>