<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	$this->module->t('admin','User Management')=>array('admin'),
	$model->username,
);

$this->menu=array(
	array('label'=>'List User', 'url'=>array('index')),
	array('label'=>'Create User', 'url'=>array('create')),
	array('label'=>'Update User', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete User', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage User', 'url'=>array('admin')),
);
?>

<h1></h1>
<div class="panel panel-default">
	<div class="panel-heading">
		<h4><span class="glyphicon glyphicon-paperclip"></span> <?php echo $this->module->t('admin','User Information');?> #<?php echo $model->username; ?></h4>
	</div>
	<div class="panel-body">
	<?php $this->widget('zii.widgets.CDetailView', array(
		'data'=>$model,
		'attributes'=>array(
			'id',
			'username',
			'password',
			'salt',
			array(
				'name'=>'role',
				'value'=>User::model()->getRoleName($model->role)
			),
			array(
				'name'=>'created',
				'value'=>date('Y年m月d日 H:i:s',$model->created)
			),
			array(
					'name'=>'lastlogin',
					'value'=>date('Y年m月d日 H:i:s',$model->lastlogin)
			),
	
		),
	
	)); ?>
	</div>
</div>
