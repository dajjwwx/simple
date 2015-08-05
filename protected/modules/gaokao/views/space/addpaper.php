<?php
/* @var $this GaokaoController */
/* @var $model Gaokao */

$this->breadcrumbs=array(
	$this->module->t('gaokao','Gaokao')=>array('index'),
	$this->module->t('gaokao','Add Paper'),
);

$this->menu=array(
	array('label'=>'List Gaokao', 'url'=>array('index')),
	array('label'=>'Manage Gaokao', 'url'=>array('admin')),
);
?>

<div class="panel panel-default">
	<div class="panel-heading">
		<span class="glyphicon glyphicon-paperclip"></span> 上传试卷
	</div>
	<div class="panel-body">
	
		<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>	

	</div>
</div>
