<?php
/* @var $this GaokaoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Gaokaos',
);

$this->menu=array(
	array('label'=>'Create Gaokao', 'url'=>array('create')),
	array('label'=>'Manage Gaokao', 'url'=>array('admin')),
);
?>

<h1>Gaokaos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
