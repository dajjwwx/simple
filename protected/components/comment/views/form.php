<?php
/* @var $this CommentController */
/* @var $model Comment */
/* @var $form CActiveForm */
?>
<?php new CActiveForm()?>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'comment-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>true,
	'enableClientValidation'=>true,
	'action'=>Yii::app()->createUrl('/administrator/comment/create'),
	'htmlOptions'=>array(
		'class'=>'form',
		'role'=>'form'
	)
)); ?>
	<br />
	<?php echo Yii::t('basic','<p class="note">Fields with <span class="required">*</span> are required.</p>');?>

	<?php echo $form->errorSummary($model); ?>

	<div class="form-group">
		<?php //echo $form->labelEx($model,'cid'); ?>
		<?php echo $form->hiddenField($model,'cid',array('class'=>'form-control','value'=>$this->id)); ?>
		<?php echo $form->error($model,'cid'); ?>
	</div>

	<div class="form-group">
		<?php //echo $form->labelEx($model,'ctype'); ?>
		<?php echo $form->hiddenField($model,'ctype',array('class'=>'form-control','value'=>$this->type)); ?>
		<?php echo $form->error($model,'ctype'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'author'); ?>
		<?php echo $form->textField($model,'author',array('size'=>30,'maxlength'=>30,'style'=>'width:50%;','class'=>'form-control','placeholder'=>Yii::t('basic','NickName'))); ?>
		<?php echo $form->error($model,'author'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>50,'maxlength'=>50,'style'=>'width:50%;','class'=>'form-control','placeholder'=>Yii::t('basic','Email'))); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'website'); ?>
		<?php echo $form->textField($model,'website',array('size'=>50,'maxlength'=>50,'style'=>'width:50%;','class'=>'form-control','placeholder'=>Yii::t('basic','Website'))); ?>
		<?php echo $form->error($model,'website'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'content'); ?>
		<?php echo $form->textArea($model,'content',array('maxlength'=>255,'rows'=>8,'class'=>'form-control','placeholder'=>Yii::t('basic','Content'))); ?>
		<?php echo $form->error($model,'content'); ?>
	</div>	
	<button type="submit" class="btn btn-primary"><?php echo Yii::t('basic',$model->isNewRecord ? 'Submit' : 'Save');?>
</button>

<?php $this->endWidget(); ?>
<!-- form -->

<script type="text/javascript">
$(function(){

	$("#comment-form").submit(function(e){

		e.preventDefault();		

		if($("#Comment_author").val() == '') {
			$("#Comment_author").focus().blur();
			return ;
		}

		if($("#Comment_email").val() == '') {
			$("#Comment_email").focus().blur();
			return ;
		}

		if($("#Comment_content").val() == '') {
			$("#Comment_content").focus().blur();
			return ;
		}
		var that = $(this);
		var url = that.attr('action');

		var data = $(this).serializeArray();

		console.log(data);

		$.post(url,data,function(msg){


			console.log(msg);
			
			alert(msg.message);

			if(msg.status == 'success'){
				that.html('<br /><p>' + msg.message + '</p>');
			}
			
		},'json');
		
		
	});
	
});
</script>