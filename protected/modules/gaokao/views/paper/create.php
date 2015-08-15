<?php
/* @var $this PaperController */
/* @var $model Paper */

$this->breadcrumbs=array(
	'Papers'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Paper', 'url'=>array('index')),
	array('label'=>'Manage Paper', 'url'=>array('admin')),
);
?>

<div class="panel panel-default">
	<div class="panel-heading">
		<span class="glyphicon glyphicon-paperclip"></span> 添加试卷名称
	</div>
	<div class="panel-body">	

		<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>	

	</div>
</div>
