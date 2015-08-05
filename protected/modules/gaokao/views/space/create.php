<?php
/* @var $this GaokaoController */
/* @var $model Gaokao */

$this->breadcrumbs=array(
	$this->module->t('gaokao','Gaokao')=>array('index'),
	Yii::t('gaokao','Upload'),
);

$this->menu=array(
	array('label'=>'List Gaokao', 'url'=>array('index')),
	array('label'=>'Manage Gaokao', 'url'=>array('admin')),
);
?>

<h1>Create Gaokao</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>