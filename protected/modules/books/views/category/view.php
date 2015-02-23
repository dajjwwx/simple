<?php
/* @var $this CategoryController */
/* @var $model BookCategory */

$this->breadcrumbs=array(
	'Book Categories'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List BookCategory', 'url'=>array('index')),
	array('label'=>'Create BookCategory', 'url'=>array('create')),
	array('label'=>'Update BookCategory', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete BookCategory', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage BookCategory', 'url'=>array('admin')),
);
?>

<div class="panel panel-default">
	<div class="panel-heading">
		<h4><span class="glyphicon glyphicon-paperclip"></span> View BookCategory #<?php echo $model->id; ?></h4>
	</div>
	<div class="panel-body">
		<?php $this->widget('zii.widgets.CDetailView', array(
			'data'=>$model,
			'attributes'=>array(
				'id',
		'pid',
		'name',
			),
		)); ?>
	</div>
</div>
