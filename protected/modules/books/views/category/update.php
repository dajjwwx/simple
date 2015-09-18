<?php
/* @var $this CategoryController */
/* @var $model BookCategory */

$this->breadcrumbs=array(
	'Book Categories'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List BookCategory', 'url'=>array('index')),
	array('label'=>'Create BookCategory', 'url'=>array('create')),
	array('label'=>'View BookCategory', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage BookCategory', 'url'=>array('admin')),
);
?>

<div class="panel panel-default">
	<div class="panel-heading"><h4><span class="glyphicon glyphicon-pencil"></span> Update BookCategory <?php echo $model->id; ?></div>
	<div class="panel-body">
		<?php $this->renderPartial('_form', array('model'=>$model)); ?>	</div>
<div>