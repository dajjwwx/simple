<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	$this->module->t('admin','User Management'),
);

$this->menu=array(
	array('label'=>'List User', 'url'=>array('index')),
	array('label'=>'Create User', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#user-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<div class="panel panel-default">
	<div class="panel-heading">
		<h4><span class="glyphicon glyphicon-th-list"></span> <?php echo $this->module->t('admin','Manage Users');?></h4>
	</div>
	
	<div class="panel-body search-form" style="display:none">
	<?php $this->renderPartial('_search',array(
		'model'=>$model,
	)); ?>
	</div><!-- search-form -->
	
	<?php $this->widget('application.components.bootstrap.BootGridView', array('data'=>array(
		'id'=>'user-grid',
		'dataProvider'=>$model->search(),
		'filter'=>$model,
		'selectableRows'=>2,	
		'columns'=>array(
			array(
				'class'=>'CCheckBoxColumn',
				'name'=>'id',
				'id'=>'select'			
			),
			'username',
	         array(               // related city displayed as a link
				'name'=>'role',
				'type'=>'raw',
				'value'=>'CHtml::encode(User::model()->getRoleName($data->role))',
			 ),
			array(
				'name'=>'created',
				'value'=>'date("M j, Y H:i:s", $data->created)',
			),
			array(
				'name'=>'lastlogin',
				'value'=>'date("M j, Y H:i:s", $data->created)',
			),
			array(
				'class'=>'CButtonColumn',
			),
	
		),	
	))); ?>
	<div class="panel-footer">
		<?php echo CHtml::link(Yii::t('basic','Advanced Search'),'#',array('class'=>'search-button')); ?>
		<p>
			<?php echo $this->module->t('admin','You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b> or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.');?>
		</p>
	</div>
</div>