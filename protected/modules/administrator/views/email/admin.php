<?php
/* @var $this EmailController */
/* @var $model Email */

$this->breadcrumbs=array(
	$this->module->t('admin','Messages'),

);

$this->menu=array(
	array('label'=>'List Email', 'url'=>array('index')),
	array('label'=>'Create Email', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#email-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<div class="panel panel-default">
	<div class="panel-heading">
		<h4><span class="glyphicon glyphicon-th-list"></span> <?php echo $this->module->t('admin','Messages');?></h4>
	</div>	
	<div class="panel-body search-form" style="display:none">
		<?php $this->renderPartial('_search',array(
			'model'=>$model,
		)); ?>
		</div><!-- search-form -->

	  <?php $this->widget('application.components.bootstrap.BootGridView', array('data'=> array(
		'id'=>'email-grid',
		'dataProvider'=>$model->search(),
	  	'selectableRows'=>2,
		'filter'=>$model,
		'columns'=>array(
			array(
					'class'=>'CCheckBoxColumn',
					'name'=>'id',
					'id'=>'select'
			),
			array(
					'name'=>'name',
					'htmlOptions'=>array('class'=>'col-md-1')	
	  		),
// 			'email',
			'subject',
			array(
					'name'=>'created',
					'value'=>'date("Y-m-d H:i:s",$data->created)',
					'htmlOptions'=>array('class'=>'col-md-2','style'=>'text-align:right;')
			),
	// 		'body',
// 			'isread',
// 			'isreply',
	// 		'reply',
			array(
				'class'=>'CButtonColumn',
				'htmlOptions'=>array('class'=>'col-md-1')
			),
		),
	))); ?>
	<div class="panel-footer"><?php echo CHtml::link($this->module->t('admin','Advanced Search'),'#',array('class'=>'search-button')); ?>
	<p><?php echo $this->module->t('admin','You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b> or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.');?></p>
	
	</div>
</div>
