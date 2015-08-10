<?php
/* @var $this CoursePaperController */
/* @var $model CoursePaper */

$this->breadcrumbs=array(
	'Course Papers'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List CoursePaper', 'url'=>array('index')),
	array('label'=>'Create CoursePaper', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#course-paper-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>


<div class="panel panel-default">
	<div class="panel-heading">
		<h4><span class="glyphicon glyphicon-th-list"></span> Manage Course Papers</h4>
	</div>
	<div class="search-form panel-body" style="display:none">
	<?php $this->renderPartial('_search',array(
		'model'=>$model,
	)); ?>
	</div><!-- search-form -->

	<?php $this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'course-paper-grid',
		'dataProvider'=>$model->search(),
		'filter'=>$model,
		'columns'=>array(
			'id',
		'province',
		'course',
		'paper',
		'year',
			array(
				'class'=>'CButtonColumn',
			),
		),
	)); ?>
	<div class="panel-footer">
		<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>		<p>
		You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
		or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
		</p>


	</div>
</div>