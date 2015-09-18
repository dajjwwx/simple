<?php
/* @var $this CategoryController */
/* @var $model BookCategory */

$this->breadcrumbs=array(
	'Book Categories'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List BookCategory', 'url'=>array('index')),
	array('label'=>'Manage BookCategory', 'url'=>array('admin')),
);
?>
<div class="panel panel-default">
	<div class="panel-heading"><h4><span class="glyphicon glyphicon-plus"></span> Create BookCategory</h4></div>
	<div class="panel-body">
		<?php $this->renderPartial('_form', array('model'=>$model)); ?>	</div>
</div>



