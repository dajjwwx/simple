<?php
/* @var $this CategoryController */
/* @var $model BookCategory */
/* @var $form CActiveForm */
?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'book-category-form',
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
		<?php echo $form->labelEx($model,'pid'); ?>
		<?php echo $form->textField($model,'pid',array('class'=>'form-control','placeholder'=>'pid')); ?>
		<?php echo $form->error($model,'pid'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('class'=>'form-control','placeholder'=>'name')); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<button type="submit" class="btn btn-default"><?php echo $model->isNewRecord ? 'Created' : 'Save';?>
</button>

<?php $this->endWidget(); ?>

</div><!-- form -->