<?php
/* @var $this GaokaoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	$this->module->t('gaokao','Gaokao')=>array('space/index'),
	$viewname
);

$this->menu=array(
	array('label'=>'Create Gaokao', 'url'=>array('create')),
	array('label'=>'Manage Gaokao', 'url'=>array('admin')),
);
?>

<div class="panel panel-default">
	<div class="panel-heading">
		<span class="glyphicon glyphicon-paperclip"></span> <?php echo Yii::t('basic','Recent Updates');?></div>
	<div class="panel-body">
		<?php $this->widget('zii.widgets.CListView', array(
			'dataProvider'=>$dataProvider,
			'itemView'=>'_view',
		)); ?>				
	</div>
</div>


