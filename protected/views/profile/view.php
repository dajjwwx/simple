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

		<!-- Nav tabs -->
		<ul class="nav nav-tabs" role="tablist">
		  <li class="active"><a href="#profile" role="tab" data-toggle="tab">基本信息</a></li>
		  <li><a href="#messages" role="tab" data-toggle="tab">Messages</a></li>
		  <li><a href="#settings" role="tab" data-toggle="tab">Settings</a></li>
		  <li><a href="#home" role="tab" data-toggle="tab">Home</a></li>
		</ul>
		
		<!-- Tab panes -->
		<div class="tab-content">
		  <div class="tab-pane active" id="home">

		  </div>
		  <div class="tab-pane" id="profile"></div>
		  <div class="tab-pane" id="messages">message</div>
		  <div class="tab-pane" id="settings">
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

