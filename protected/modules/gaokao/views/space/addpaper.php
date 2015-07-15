<?php
/* @var $this GaokaoController */
/* @var $model Gaokao */

$this->breadcrumbs=array(
	'Gaokaos'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Gaokao', 'url'=>array('index')),
	array('label'=>'Manage Gaokao', 'url'=>array('admin')),
);
?>

<h1><?php echo $this->module->t('gaokao','Add Paper'); ?></h1>

<div class="panel panel-default">
	<div class="panel-heading">
		<span class="glyphicon glyphicon-paperclip"></span> 上传试卷
	</div>
	<div class="panel-body">
	
		<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>	

	</div>
	</div>
</div>


<