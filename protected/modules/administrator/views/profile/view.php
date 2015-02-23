<?php
/* @var $this ProfileController */
/* @var $model Profile */

$this->breadcrumbs=array(
	'Profiles'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Profile', 'url'=>array('index')),
	array('label'=>'Create Profile', 'url'=>array('create')),
	array('label'=>'Update Profile', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Profile', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Profile', 'url'=>array('admin')),
);
?>

<div class="panel panel-default">
	<div class="panel-heading">
		<h4><span class="glyphicon glyphicon-paperclip"></span> View Profile #<?php echo $model->id; ?></h4>
	</div>
	<div class="panel-body">
		<?php $this->widget('zii.widgets.CDetailView', array(
			'data'=>$model,
			'attributes'=>array(
				'id',
		'uid',
		'firstname',
		'lastname',
		'nickname',
		'avatar',
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
			),
		)); ?>
	</div>
</div>
