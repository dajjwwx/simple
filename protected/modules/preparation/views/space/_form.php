<?php
/* @var $this SpaceController */
/* @var $model Preparation */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'preparation-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

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

				if(!checkData()) return false;
				
				var course = YKG.app("form").getSelectedOptionText($("#Gaokao_course")[0]);
				var year = YKG.app("form").getSelectedOptionText($("#Gaokao_year")[0]);
				var paper = YKG.app("string").trim($("#loadPaper .selected").text());
				var pid = $("#Gaokao_pid").val();

				// var body = "文件名至少要含有如下关键字\""+course+","+year+","+paper;
				var body = "请把文件名改为：\""+ year +"年" + course + paper + ".pdf";

				// console.log(pid);
				// alert(pid);

				var filename = files[0].name;

				if(filename.indexOf(course) >= 0 && filename.indexOf(year) >= 0 && filename.indexOf(paper) >= 0 && pid == ""){
					return true;
				}

				if(pid != ""){
					if(filename.indexOf(course) >= 0 && filename.indexOf(year) >= 0 && filename.indexOf(paper) >= 0 && filename.indexOf("答案")>=0){
						return true;
					}
					body = body + "答案";	
				}

				body = body + "\"";

				YKG.app("bootstrap").showModal({
					"id":"defaultModal",
					"title":"操作提示",
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

	<div class="row">
		<?php echo $form->labelEx($model,'cid'); ?>
		<?php echo $form->textField($model,'cid'); ?>
		<?php echo $form->error($model,'cid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fid'); ?>
		<?php echo $form->textField($model,'fid'); ?>
		<?php echo $form->error($model,'fid'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->