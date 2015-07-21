<?php
/* @var $this GaokaoController */
/* @var $model Gaokao */

$this->breadcrumbs=array(
	'Gaokaos'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Gaokao', 'url'=>array('index')),
	array('label'=>'Create Gaokao', 'url'=>array('create')),
	array('label'=>'Update Gaokao', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Gaokao', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Gaokao', 'url'=>array('admin')),
);
?>

<a href="<?php echo $this->createUrl('viewsingle',array('file'=>'/public/upload/GaoKao/2015/07/20/d01cfd6d4f77aaa9701d06c9909f2c81.pdf')); ?>">查看</a>

<h1>View Gaokao #<?php echo $model->id; ?></h1>

<?php
	$this->widget('ext.pdfobject.PDFObjectWidget',array(
		'file'=>'/public/upload/GaoKao/2015/07/20/d01cfd6d4f77aaa9701d06c9909f2c81.pdf',
	));
?>





<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'course',
		'year',
		'province',
		'fid',
	),
)); ?>

