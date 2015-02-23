<?php
/* @var $this ProfileController */
/* @var $model Profile */

$this->breadcrumbs=array(
	'Profiles'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Profile', 'url'=>array('index')),
	array('label'=>'Create Profile', 'url'=>array('create')),
	array('label'=>'View Profile', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Profile', 'url'=>array('admin')),
);
?>
		<!-- Nav tabs -->
		<ul class="nav nav-tabs" role="tablist" id="tabs">			
		  
		  <li><a href="#basic" role="tab" data-toggle="tab">基本信息</a></li>
		  <li><a href="#head" role="tab" data-toggle="tab">设置头像</a></li>
		  <li><a href="#study" role="tab" data-toggle="tab">学习/工作</a></li>
		  <li><a href="#contact" role="tab" data-toggle="tab">联系方式</a></li>
		  <li class="active"><a href="#favor" role="tab" data-toggle="tab">兴趣爱好</a></li>
		</ul>
		
		<!-- Tab panes -->
		<div class="tab-content">		  

	 
		   <div class="tab-pane " id="basic">
		  	<br />
			<?php $this->renderPartial('_basic', array('model'=>$model)); ?>
		  </div>
		  <div class="tab-pane" id="head">
		  	<br />
		  	<?php $this->renderPartial('_head',array('model'=>$model));?>
		  </div>
		  <div class="tab-pane" id="contact">
		  	<br />
		  	<?php $this->renderPartial('_contact',array('model'=>$model));?>
		  </div>
		  <div class="tab-pane" id="study">
		  	<br />
		  	<?php $this->renderPartial('_study',array('model'=>$model));?>
		  </div>	
		  <div class="tab-pane active" id="favor">
		  	<br />
		  	<?php $this->renderPartial('_favor',array('model'=>$favor));?>
		  </div>
		</div>
		
		<script type="text/javascript">
		$(function(){
// 			alert(location.hash);

			var index = $("#tabs a[href='"+location.hash+"']").parent().index();

			if(index > -1)
				$("#tabs a:eq("+index+")").tab('show');
			
		});
		</script>

