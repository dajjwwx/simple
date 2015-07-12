<?php
/* @var $this SpaceController */
/* @var $model Books */

$this->breadcrumbs=array(
	'Books'=>array('index'),
	$model->info->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Books', 'url'=>array('index')),
	array('label'=>'Create Books', 'url'=>array('create')),
	array('label'=>'View Books', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Books', 'url'=>array('admin')),
);
?>

<div class="panel panel-default">
	<div class="panel-heading"><h4><span class="glyphicon glyphicon-pencil"></span> Update Books <?php echo $model->id; ?></div>
	<div class="panel-body">
		<?php $this->renderPartial('_form', array('model'=>$model->info)); ?>	</div>
<div>