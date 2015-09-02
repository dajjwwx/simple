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
<style type="text/css">
.list{
	margin: 0;
	padding: 0;
	list-style-type: none;
}
</style>
<div class="panel panel-default">
	<div class="panel-heading"><?php echo Yii::app()->getModule('preparation')->t('preparations','Upload Preparation');?></div>
		<div class="panel-body">
			<div class=" widget">
				<?php $this->renderPartial('_form', array('model'=>$model)); ?>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">

function loadTextBooks(object)
{
	YKG.app().form().singleChoice(object,'Preparation_Course');

	YKG.app().dom().preAjax($("#loadTextBooks"));

	$.get('/preparation/catalog/catalog.html',{'pid':0,'course':object.attr('id')},function(data){
		
		var datalist = {
			'list': data
		};

		var html = baidu.template('textBooks',datalist);
		$("#loadTextBooks").html(html);
	},'json');

}

function loadChapters(object)
{
	YKG.app().form().singleChoice(object,'Preparation_Chapter');

	YKG.app().dom().preAjax($("#loadChapters"));

	$.get('/preparation/catalog/catalog.html',{'pid':object.attr('id'),'course':$("#Preparation_Course").val()},function(data){
		
		var datalist = {
			'list': data
		};

		var html = baidu.template('chapters',datalist);
		$("#loadChapters").html(html);
	},'json');	
}

function setCatalogID(object)
{
	YKG.app().form().singleChoice(object,'Preparation_cid');
}


$(function(){



	// var data = {
	// 	name:"Hello world",
	// 	list:['test1','test2','test3']
	// };

	// var html = baidu.template('textBooks',data);

	// $("#loadTextBooks").html(html);
});
</script>
