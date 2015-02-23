<?php
/* @var $this CategoryController */
/* @var $model Category */

$this->breadcrumbs=array(
	$this->module->t('admin','Categories')=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Category', 'url'=>array('index')),
	array('label'=>'Create Category', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#category-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<div class="panel panel-default">
	<div class="panel-heading">
		<h4><span class="glyphicon glyphicon-th-list"></span> Manage Categories</h4>
	</div>
	<div class="search-form panel-body" style="display:none">
	<?php $this->renderPartial('_search',array(
		'model'=>$model,
	)); ?>
	</div><!-- search-form -->

	<?php $this->widget('application.components.bootstrap.BootGridView', array('data'=>array(
		'id'=>'category-grid',
		'dataProvider'=>$model->search(),
	  	'selectableRows'=>2,
		'filter'=>$model,
		'columns'=>array(
			array(
					'class'=>'CCheckBoxColumn',
					'name'=>'id',
					'id'=>'select'
			),
		'name',
		'weight',
		array(
			'name'=>'type',
			'value'=>'Category::model()->getCategoryTypeName($data->type)'		
		),
		'description',
		'pid',
		/*
		'uid',
		*/
			array(
				'class'=>'CButtonColumn',
			),
		),
	))); ?>
	<div class="panel-footer">
		<a class="search-button" href="#">高级查询</a>		<p>
			您可以根据搜索需要选择比较操作符(“<”, “<=”, “>”, “>=”, “<>” 或者 “=”)进行搜索。		</p>
	</div>
</div>
