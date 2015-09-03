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

function checkUploadData(){
	var cid = $("#Preparation_cid").val();
	var course = $("#Preparation_Course").val();
	var chapter = $("#Preparation_Chapter").val();

	var body = "";

	if(cid != "" && course != "" && chapter != ""){
		return true;
	}

	if(cid == ""){
		body = "请选择章节";
	}

	if(course == ""){
		body = "请选择科目";
	}

	if(chapter == ""){
		body = "请选择课本"
	}


	YKG.app("bootstrap").showModal({
		"id":"defaultModal",
		"title":"操作提示",
		"body":body,
		"showEvent":function(){
			// alert("HEllo wrld");
		}
	}).show().showEvent();
	return false;
}

function checkPreparationData()
{
	var uploadData = checkUploadData();
	if(uploadData){
		var fid = $("#Preparation_fid").val();

		if(fid != ""){
			return true;
		}else{

			YKG.app("bootstrap").showModal({
				"id":"defaultModal",
				"title":"操作提示",
				"body":"请先上传课件",
				"showEvent":function(){
					// alert("HEllo wrld");
				}
			}).show().showEvent();

		}

	}
}

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

function loadExistsFiles()
{

	$.get('/preparation/space/chapterfiles.html',{'id':$("#Preparation_cid").val()},function(data){

		var datalist = {
			'list': data
		};

		var html = baidu.template('existsFiles',datalist);
		$("#existsFilesBox").html(html);

	},'json');
}

function setCatalogID(object)
{
	YKG.app().form().singleChoice(object,'Preparation_cid');

	loadExistsFiles();
}


$(function(){
	$("#preparation-form").submit(function(){

		var params = $(this).serializeArray();

		$.post('/preparation/space/create.html',params,function(data){

			loadExistsFiles();

		},'json');


		return false;			
	});
});
</script>
