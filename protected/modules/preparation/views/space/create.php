<?php
/* @var $this SpaceController */
/* @var $model Preparation */

$this->breadcrumbs=array(
	'Preparations'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Preparation', 'url'=>array('index')),
	array('label'=>'Manage Preparation', 'url'=>array('admin')),
);
?>

<div class="panel panel-default">
	<div class="panel-heading"><?php echo Yii::app()->getModule('preparation')->t('preparations','Upload Preparation');?></div>
		<div class="panel-body">
			<div class="widget">
				<blockquote>
					<p>这里上传课件,上传文件流程如下：</p>
					<small>选择科目-->选择课件所属目录-->上传课件-->提交数据</small>
				</blockquote>
				<?php $this->renderPartial('_form', array('model'=>$model)); ?>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
$(function(){
	$("#preparation-form").submit(function(){

		var params = $(this).serializeArray();
		params.r = Math.random(); 

		$.post('/preparation/space/create.html',params,function(data){

			console.log(data);

			alert(data);

			loadExistsFiles();

		},'json');


		return false;			
	});
});
</script>
