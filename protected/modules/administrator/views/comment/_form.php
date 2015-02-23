<?php
/* @var $this CommentController */
/* @var $model Comment */
/* @var $form CActiveForm */
?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'comment-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array(
		'class'=>'form',
		'role'=>'form'
	)
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="form-group">
		<?php echo $form->labelEx($model,'cid'); ?>
		<?php echo $form->textField($model,'cid',array('class'=>'form-control','placeholder'=>'cid')); ?>
		<?php echo $form->error($model,'cid'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'pid'); ?>
		<?php echo $form->textField($model,'pid',array('class'=>'form-control','placeholder'=>'pid')); ?>
		<?php echo $form->error($model,'pid'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'uid'); ?>
		<?php echo $form->textField($model,'uid',array('class'=>'form-control','placeholder'=>'uid')); ?>
		<?php echo $form->error($model,'uid'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'ctype'); ?>
		<?php echo $form->textField($model,'ctype',array('class'=>'form-control','placeholder'=>'ctype')); ?>
		<?php echo $form->error($model,'ctype'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->textField($model,'status',array('class'=>'form-control','placeholder'=>'status')); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'author'); ?>
		<?php echo $form->textField($model,'author',array('size'=>30,'maxlength'=>30,'class'=>'form-control','placeholder'=>'author')); ?>
		<?php echo $form->error($model,'author'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>50,'maxlength'=>50,'class'=>'form-control','placeholder'=>'email')); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'website'); ?>
		<?php echo $form->textField($model,'website',array('size'=>50,'maxlength'=>50,'class'=>'form-control','placeholder'=>'website')); ?>
		<?php echo $form->error($model,'website'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'agent'); ?>
		<?php echo $form->textField($model,'agent',array('size'=>60,'maxlength'=>255,'class'=>'form-control','placeholder'=>'agent')); ?>
		<?php echo $form->error($model,'agent'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'ip'); ?>
		<?php echo $form->textField($model,'ip',array('size'=>30,'maxlength'=>30,'class'=>'form-control','placeholder'=>'ip')); ?>
		<?php echo $form->error($model,'ip'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'content'); ?>
		<?php echo $form->textField($model,'content',array('size'=>60,'maxlength'=>255,'class'=>'form-control','placeholder'=>'content')); ?>
		<?php echo $form->error($model,'content'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'pubdate'); ?>
		<?php echo $form->textField($model,'pubdate',array('class'=>'form-control','placeholder'=>'pubdate')); ?>
		<?php echo $form->error($model,'pubdate'); ?>
	</div>

	<button type="submit" class="btn btn-default"><?php echo $model->isNewRecord ? 'Created' : 'Save';?>
</button>

<?php $this->endWidget(); ?>

</div><!-- form -->