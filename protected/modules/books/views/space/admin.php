<?php
/* @var $this SpaceController */
/* @var $model Books */

$this->breadcrumbs=array(
	'Books'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Books', 'url'=>array('index')),
	array('label'=>'Create Books', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#books-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>


<div class="panel panel-default">
	<div class="panel-heading">
		<h4><span class="glyphicon glyphicon-th-list"></span> Manage Books</h4>
	</div>
	<div class="search-form panel-body" style="display:none">
	<?php $this->renderPartial('_search',array(
		'model'=>$model,
	)); ?>
	</div><!-- search-form -->
	
	<?php $this->widget('application.components.bootstrap.BootGridView', array('data'=>array(
		'id'=>'books-grid',
		'dataProvider'=>$model->search(),
		'filter'=>$model,
		'columns'=>array(
		// 'id',
		array(
			'name'=>'image',
			'type'=>'raw',
			'value'=>'CHtml::image($data->image)'
		),
		'title',
		// 'origin_title',
		// 'subtitle',
		// 'pubdate',
		// 'isbn10',

		// 'isbn13',
		// 'author',		
		// 'summary',
		'tags',
		// 'catelog',
		'binding',
		// array(
			// 'name'=>'translator',
			// 'value'=>'is_array($data->translator)?implode(",", $data->translator):$data->translator'
		// ),
		'pages',
		'publisher',
		// 'alt_title',
		// 'author_intro',
		'price',
		array(
				'class'=>'CButtonColumn',
			),
		),
	))); ?>
	<div class="panel-footer">
		<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>		<p>
		You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
		or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
		</p>


	</div>
</div>