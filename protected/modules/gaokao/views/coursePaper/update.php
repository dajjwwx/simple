<?php
/* @var $this CoursepaperController */
/* @var $model Coursepaper */

$this->breadcrumbs=array(
	'Coursepapers'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Coursepaper', 'url'=>array('index')),
	array('label'=>'Create Coursepaper', 'url'=>array('create')),
	array('label'=>'View Coursepaper', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Coursepaper', 'url'=>array('admin')),
);
?>

<h1>Update Coursepaper <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>

<div class="panel panel-default">
	<div class="panel-heading">
		<span class="glyphicon glyphicon-paperclip"></span> 更新高考卷（<?php echo $model->name;?>）信息
	</div>
	<div class="panel-body">	
		
		<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>	

	</div>
</div>
