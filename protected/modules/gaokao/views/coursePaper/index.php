<?php
/* @var $this CoursePaperController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Course Papers',
);

$this->menu=array(
	array('label'=>'Create CoursePaper', 'url'=>array('create')),
	array('label'=>'Manage CoursePaper', 'url'=>array('admin')),
);
?>


<div class="panel panel-default">
	<div class="panel-heading">
		<h4><span class="glyphicon glyphicon-list"></span> Course Papers</h4>
	</div>
	<div class="panel-body">
		<?php $this->widget('zii.widgets.CListView', array(
			'dataProvider'=>$dataProvider,
			'itemView'=>'_view',
		)); ?>
	</div>
</div>