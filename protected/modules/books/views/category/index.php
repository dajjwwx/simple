<?php
/* @var $this CategoryController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Book Categories',
);

$this->menu=array(
	array('label'=>'Create BookCategory', 'url'=>array('create')),
	array('label'=>'Manage BookCategory', 'url'=>array('admin')),
);
?>


<div class="panel panel-default">
	<div class="panel-heading">
		<h4><span class="glyphicon glyphicon-list"></span> Book Categories</h4>
	</div>
	<div class="panel-body">
		<?php $this->widget('zii.widgets.CListView', array(
			'dataProvider'=>$dataProvider,
			'itemView'=>'_view',
		)); ?>
	</div>
</div>