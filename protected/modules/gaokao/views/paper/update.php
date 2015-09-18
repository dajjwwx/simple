<?php
/* @var $this PaperController */
/* @var $model Paper */

$this->breadcrumbs=array(
	'Papers'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Paper', 'url'=>array('index')),
	array('label'=>'Create Paper', 'url'=>array('create')),
	array('label'=>'View Paper', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Paper', 'url'=>array('admin')),
);
?>

<div class="panel panel-default">
	<div class="panel-heading">
		<span class="glyphicon glyphicon-paperclip"></span> 更新<?php echo $model->name;?>
	</div>
	<div class="panel-body">	
		
		<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>	

	</div>
</div>