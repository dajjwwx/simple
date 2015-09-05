<?php
/* @var $this SpaceController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	$this->module->t('preparation','Preparations'),
);

$this->menu=array(
	array('label'=>'Create Preparation', 'url'=>array('create')),
	array('label'=>'Manage Preparation', 'url'=>array('admin')),
);
?>

<div class="panel panel-default">
	<div class="panel-heading">
		<span class="glyphicon glyphicon-paperclip"></span> <?php echo $this->module->t('preparation','Preparations');?>
	</div>
	<div class="panel-body">
		<?php $this->widget('zii.widgets.CListView', array(
			'dataProvider'=>$dataProvider,
			'itemView'=>'_view',
		)); ?>
	</div>
</div>
<h1></h1>

