<?php
/* @var $this GaokaoController */
/* @var $model Gaokao */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'gaokao-form',
	'enableAjaxValidation'=>true,
)); ?>
	
	<blockquote>
		<p>上传试题及答案说明：</p>
		<small>上传试题前务必保证文件名指明年份，科目（文理），如“2014年高考理科数学四川卷真题”</small>
		<small>上传试题答案前务必保证文件名指明年份，科目（文理），并在最后加上“答案”二字，如“2014年高考理科数学四川卷真题答案”</small>
	</blockquote>

	<?php echo Yii::t('basic','<p class="note">Fields with <span class="required">*</span> are required.</p>');?>

	<?php echo $form->errorSummary($model); ?>
	
	<div class="form-group">
		<?php //UtilHelper::dump(Gaokao::model()->getCoursesList()); ?>
		<?php echo $form->labelEx($model,'course'); ?>
		<?php echo $form->dropDownList($model,'course',Gaokao::model()->getCoursesList(),array('class'=>"form-control",'placeholder'=>$this->module->t('gaokao','Course'))); ?>
		<?php echo $form->error($model,'course'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'year'); ?>
		<?php echo $form->dropDownList($model,'year',Gaokao::model()->getYearsList(),array('class'=>"form-control",'placeholder'=>$this->module->t('gaokao','Year'))); ?>
		<?php echo $form->error($model,'year'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'paper'); ?>
		
		<div id="loadPaper">
			<blockquote><small>选择年份，加载试卷类型</small></blockquote>
		</div>		
		
		<?php echo $form->hiddenField($model,'paper',array('size'=>32,'maxlength'=>32,'class'=>"form-control")); ?>
		<?php echo $form->error($model,'paper'); ?>
	</div>

	<div class="form-group">
		<?php //echo $form->labelEx($model,'fid'); ?>
		<?php echo $form->hiddenField($model,'fid'); ?>
		<?php echo $form->error($model,'fid'); ?>
	</div>

	<div class="form-group">
		<?php //echo $form->labelEx($model,'pid'); ?>
		<?php echo $form->hiddenField($model,'pid'); ?>
		<?php echo $form->error($model,'pid'); ?>

		<div id="uploadPaper"></div>

	</div>

	<div class="form-group">
	<?php
		$this->widget('ext.jqueryupload.JqueryUploadWidget',array(
			'url'=>Yii::app()->createUrl('/gaokao/space/upload'),
			'method'=>'POST',
			'id'=>'multiplyfileuploader',
			'allowedTypes'=>'pdf',//只允许上传PDF文件
			'fileName'=>'Filedata',
			'returnType'=>"json",
			'maxFileSize'=>5*1024*1024,
			//'showDownload'=>true,
			//'statusBarWidth'=>600,
			//'dragdropWidth'=>600,
			'multiple'=>false,
			'extErrorStr'=>'允许上传的文件格式为：',
			'sizeErrorStr'=>'您的文件太大了，最大只能上传',
			'showDelete'=>true,
			'deleteCallback'=>'js:function (data, pd) {
				for (var i = 0; i < data.length; i++) {
					$.post("delete.php", {op: "delete",name: data[i]},
						function (resp,textStatus, jqXHR) {
							//Show Message	
							alert("File Deleted");
						});
				}
				pd.statusbar.hide(); //You choice.

			}',
			'onSelect'=>'js:function(files){
				
				var course = YKG.app("form").getSelectedOptionText($("#Gaokao_course")[0]);
				var year = YKG.app("form").getSelectedOptionText($("#Gaokao_year")[0]);
				var paper = YKG.app("string").trim($("#loadPaper .selected").text());
				var pid = $("#Gaokao_pid").val();

				var body = "文件名至少要含有如下关键字\""+course+","+year+","+paper;

				console.log(pid);

				var filename = files[0].name;

				if(filename.indexOf(course) >= 0 && filename.indexOf(year) >= 0 && filename.indexOf(paper) >= 0 && pid == ""){
					return true;
				}

				if(pid != ""){
					if(filename.indexOf(course) >= 0 && filename.indexOf(year) >= 0 && filename.indexOf(paper) >= 0 && filename.indexOf('答案'') >= 0)){
						return true;
					}	

					body = body + '答案';	
				}


				body = body + "\"";

				YKG.app("bootstrap").showModal({
					"id":"defaultModal",
					"title":"Title",
					"body":body,
					"showEvent":function(){
						alert("HEllo wrld");
					}
				}).show().showEvent();

				return false;

			}',
			'onLoad'=>'js:function(obj){
				console.log($("#gaokao_form").serializeArray());
				
				console.log(obj);
				
				alert($("#Gaokao_course").val());
				
				return false;
			}',
			'onSuccess'=>'js:function(files,data,xhr)
			{	
				$("#status").html("<font color=\'green\'>Upload is success</font>").fadeOut(1000);
				
				console.log(data);	
				console.log(files);					
				$("#Gaokao_fid").val(data.id);			
				
			}',
			'onError'=>'js:function(files,status,errMsg){		
				console.log(errMsg);	
				$("#status").html("<font color=\"red\">Upload is Failed</font>");
			}'	
		));
	?>
		<div id="multiplyfileuploader"><?php echo $this->module->t('gaokao','Add Paper');?></div>  
		<div id="status"></div> 
	</div>
	
	<div class="form-group buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? $this->module->t('gaokao','Add Paper') : Yii::t('basic','Save'),array('class'=>'btn btn-default')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->


<script type="text/javascript">
//暂留下，已经被替换为YKG.app('form').singleChoice(object,input)
function checkPaperExists(object){

	YKG.app('form').singleChoice(object,'Gaokao_paper');

	var params = {
		'paper':object.attr('id'),
		'course':$("#Gaokao_course").val(),
		'year':$("#Gaokao_year").val()
	};

	// $("#uploadPaper").show();

	//根据获取到的文件存在信息，控制$("#multiplyfileuploader")的显示与隐藏
	$.get('/gaokao/space/checkpaperexists.html',params,function(data){
		if(data == 1){
			
			$("#multiplyfileuploader").parent().hide();

			YKG.app('dom').preAjax($("#uploadPaper"));

			$.get('/gaokao/space/paperitems.html',params,function(data){
				//加载已经上传试卷
				console.log(data);
				$("#uploadPaper").html('<br />'+data);
			});
		}else{

			var html = $('<b style="border:1px dashed grey;">文件还没有上传</b>');

			$("#uploadPaper").empty().append(html);

			html.animate({
				'font-size':'36px'
			}).fadeOut(3000);

			$("#multiplyfileuploader").parent().show();
		}
	});

	// window.event.preventDefault();


	//加载已经上传试卷
	//$("#uploadPaper").load('/gaokao/space/paperitems.html?province='+object.attr('id')+'&year='+$("#Gaokao_year").val()+'&course='+$("#Gaokao_course").val());
}

function deletePaper(object)
{
	$.post(object.attr('href'),{},function(data){
		if(data == 1){
			alert("删除成功");

			obejct.parent().parent().hide();
		}else{
			alert("删除失败");
		}

	});

	// window.event.preventDefault();

		
}

function uploadPaperKey(object)
{
	$('#Gaokao_pid').val(object.attr('id'));
	$("#multiplyfileuploader").parent().show();
}


$(function(){

	$("#mulitplefileuploader").parent().hide();

	$("#Gaokao_year").change(function(){
		YKG.app('dom').preAjax($("#loadPaper"));
		$("#loadPaper").load('/gaokao/paper/paper.html?year='+$(this).val());
	});

	$("#gaokao-form").submit(function(){

		if($("#Gaokao_course").val() == ''){
			alert("还没选择科目");
			return false;
		}

		if($("#Gaokao_year").val() == ''){
			alert("还没选择年份");
			return false;
		}

		if($("#Gaokao_paper").val() == ''){
			alert("还没选择试题名称");
			return false;
		}


		var data = $(this).serializeArray();
		$.post('<?php echo $this->createUrl("/gaokao/space/create");?>',data,function(result){
			console.log(result);
			$(".buttons").append('&nbsp;&nbsp;&nbsp;&nbsp;<a href="/gaokao/space/view/'+result.id+'.html">查看试卷</a></span>');



		},'json');	

		console.log($(this).serializeArray());
		return false;
	});	
});
</script>