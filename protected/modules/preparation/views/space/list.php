<?php
/* @var $this SpaceController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	$this->module->t('preparation','Preparations')=>array('/preparation/space'),
	Catalog::model()->getCourseName($model->course)=>array('space/course','id'=>$model->course),
);

$this->menu=array(
	array('label'=>'Create Preparation', 'url'=>array('create')),
	array('label'=>'Manage Preparation', 'url'=>array('admin')),
);

$menu = array_reverse(Catalog::model()->generateBreadcrumbs($model->id, $model->course));

$this->breadcrumbs = array_merge($this->breadcrumbs,$menu);



// $this->breadcrumbs = array_merge($this->breadcrumbs,array(UtilString::strSlice($model->file->name,0,50)));

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


