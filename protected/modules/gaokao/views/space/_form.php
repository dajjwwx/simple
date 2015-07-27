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
	<p class="note">Fields with <span class="required">*</span> are required.</p>
	
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
		<?php echo $form->labelEx($model,'province'); ?>
		<?php foreach(Gaokao::model()->getProvinces() as $k=>$province):?>
			<span class="item"><a href="javascript:void(0);" class="provinceItem" onclick="addIds($(this));" id="<?php echo $k; ?>"><?php echo $province; ?></a></span> | 
		<?php endforeach;?>
		<?php echo $form->hiddenField($model,'province',array('size'=>32,'maxlength'=>32,'class'=>"form-control")); ?>
		<?php echo $form->error($model,'province'); ?>
	</div>

	<div class="form-group">
		<?php //echo $form->labelEx($model,'fid'); ?>
		<?php echo $form->hiddenField($model,'fid'); ?>
		<?php echo $form->error($model,'fid'); ?>
	</div>

	<div class="form-group">
	<?php
		$this->widget('ext.jqueryupload.JqueryUploadWidget',array(
			'url'=>Yii::app()->createUrl('/gaokao/space/upload'),
			'method'=>'POST',
			'id'=>'mulitplefileuploader',
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
		<div id="mulitplefileuploader">上传试卷</div>  
		<div id="status"></div> 
	</div>
	
	<div class="form-group buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'btn btn-default')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<script type="text/javascript">
function addIds(object){
	if(object.parent().hasClass('selected')){
		object.parent().removeClass('selected');
		object.parent().css({border:'none'});
	}else{
		object.parent().addClass('selected');
		object.parent().css({border:'1px solid grey'});
	}
	var result = '';
	$('.selected a').each(function(i){
		result = result + $(this).attr('id') + ',';
	});
	
	result = result.substring(0,result.length-1);
	
	$("#Gaokao_province").val(result);
}



$(function(){
	$("#gaokao-form").submit(function(){
		var data = $(this).serializeArray();
		$.post('<?php echo $this->createUrl("/gaokao/space/addpaper");?>',data,function(result){
			console.log(result);
		});	

		console.log($(this).serializeArray());
		return false;
	});	
});
</script>