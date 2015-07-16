<?php
/* @var $this GaokaoController */
/* @var $model Gaokao */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'gaokao-form',
	'enableAjaxValidation'=>false,
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
		<?php echo $form->dropDownList($model,'year',Gaokao::model()->getYearsList(),array('size'=>4,'maxlength'=>4,'class'=>"form-control",'placeholder'=>$this->module->t('gaokao','Year'))); ?>
		<?php echo $form->error($model,'year'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'province'); ?>
		<?php echo $form->textField($model,'province',array('size'=>32,'maxlength'=>32,'class'=>"form-control")); ?>
		<?php echo $form->error($model,'province'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'fid'); ?>
		<?php echo $form->textField($model,'fid'); ?>
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
			'maxFileSize'=>5*1024*1024,
			'multiple'=>false,
			'extErrorStr'=>'允许上传的文件格式为：',
			'sizeErrorStr'=>'您的文件太大了，最大只能上传',
			'onLoad'=>'js:function(obj){
				alert("Hello");
				return ;
			}',
			'onSuccess'=>'js:function(files,data,xhr)
			{	
				$("#status").html("<font color=\'green\'>Upload is success</font>").fadeOut(1000);
				console.log(data);
				console.log(files);			
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
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->