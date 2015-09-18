<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	$this->module->t('admin','User Management')=>array('admin'),
	$this->module->t('admin','Create User'),
);

$this->menu=array(
	array('label'=>'List User', 'url'=>array('index')),
	array('label'=>'Manage User', 'url'=>array('admin')),
);
?>

<div class="panel panel-default">
	<div class="panel-heading"><h4><span class="glyphicon glyphicon-plus"></span> <?php echo $this->module->t('admin','Create User');?></div>
	<div class="panel-body">
		<?php $this->renderPartial('_form', array('model'=>$model)); ?>	</div>
</div>