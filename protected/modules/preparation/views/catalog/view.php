<?php
/* @var $this CatalogController */
/* @var $model Catalog */

$this->breadcrumbs=array(
	'Catalogs'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Catalog', 'url'=>array('index')),
	array('label'=>'Create Catalog', 'url'=>array('create')),
	array('label'=>'Update Catalog', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Catalog', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Catalog', 'url'=>array('admin')),
);
?>

<h1>View Catalog #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'pid',
		'course',
	),
)); ?>
