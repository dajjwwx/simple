<?php
/* @var $this CoursepaperController */
/* @var $model Coursepaper */

$this->breadcrumbs=array(
	'Coursepapers'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Coursepaper', 'url'=>array('index')),
	array('label'=>'Manage Coursepaper', 'url'=>array('admin')),
);
?>

<div class="panel panel-default">
	<div class="panel-heading">
		<span class="glyphicon glyphicon-paperclip"></span> 添加特殊试卷
	</div>
	<div class="panel-body">	
		
		<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>	

	</div>
</div>
