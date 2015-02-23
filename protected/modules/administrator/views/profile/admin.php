<?php
/* @var $this ProfileController */
/* @var $model Profile */

$this->breadcrumbs=array(
	'Profiles'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Profile', 'url'=>array('index')),
	array('label'=>'Create Profile', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#profile-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>


<div class="panel panel-default">
	<div class="panel-heading">
		<h4><span class="glyphicon glyphicon-th-list"></span> Manage Profiles</h4>
	</div>
	<div class="search-form panel-body" style="display:none">
	<?php $this->renderPartial('_search',array(
		'model'=>$model,
	)); ?>
	</div><!-- search-form -->

	<?php $this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'profile-grid',
		'dataProvider'=>$model->search(),
		'filter'=>$model,
		'columns'=>array(
			'id',
		'uid',
		'firstname',
		'lastname',
		'nickname',
		'avatar',
		/*
		'gender',
		'calendar',
		'birth',
		'birthyear',
		'birthmonth',
		'birthday',
		'blood',
		'marry',
		'email',
		'phone',
		'qq',
		'alipay',
		'job',
		'companyname',
		'companyaddress',
		'primaryschool',
		'middleschool',
		'highschool',
		'university',
		'country',
		'province',
		'manicipal',
		'village',
		'county',
		'homeprovince',
		'homemanicipal',
		'homecounty',
		'homevillage',
		'addressdetail',
		'homeaddressdetail',
		*/
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