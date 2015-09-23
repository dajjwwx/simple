<?php
/* @var $this SpaceController */
/* @var $model Blog */

$this->breadcrumbs=array(
	'Blogs'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Blog', 'url'=>array('index')),
	array('label'=>'Create Blog', 'url'=>array('create')),
	array('label'=>'View Blog', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Blog', 'url'=>array('admin')),
);
?>

<div class="panel panel-default">
	<div class="panel-heading">
		<h4>
			<span class="glyphicon glyphicon-pencil"></span> Update Blog <?php echo $model->id; ?>
		</h4>
	
	</div>
	<div class="panel-body">
		<?php $this->renderPartial('_form', array('model'=>$model)); ?>	
	</div>
</div>