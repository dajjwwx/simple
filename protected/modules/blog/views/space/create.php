<?php
/* @var $this SpaceController */
/* @var $model Blog */

$this->breadcrumbs=array(
	Yii::t('blog','Blog')=>array('index'),
	Yii::t('blog','Create Blog'),
);

$this->menu=array(
	array('label'=>'List Blog', 'url'=>array('index')),
	array('label'=>'Manage Blog', 'url'=>array('admin')),
);
?>
<div class="panel panel-default">
	<div class="panel-heading"><h4><span class="glyphicon glyphicon-plus"></span> <?php echo Yii::t('blog','Create Blog');?></h4></div>
	<div class="panel-body">
		<?php $this->renderPartial('_form', array('model'=>$model)); ?>	</div>
</div>



