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


<?php 
$folder = Yii::app()->params->uploadGaoKaoPath;
$targetFile = File::model()->attributeAdapter($model->file)->getFilePath($folder, false, false);
// echo $targetFile;
?>




<?php
	$this->widget('ext.pdfobject.PDFObjectWidget',array(
		'file'=>$targetFile,
	));
?>

<a href="<?php echo $this->createUrl('viewsingle',array('file'=>$targetFile)); ?>">全屏查看</a>

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

