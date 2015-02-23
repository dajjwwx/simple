<?php
/* @var $this SpaceController */
/* @var $model Books */
/* @var $form CActiveForm */
?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'bookstore-form',
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
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>50,'maxlength'=>50,'class'=>'form-control','placeholder'=>'书库名称')); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'address'); ?>
		<?php echo $form->textField($model,'address',array('size'=>60,'maxlength'=>128,'class'=>'form-control','placeholder'=>'书库地址')); ?>
		<?php echo $form->error($model,'address'); ?>
	</div>

	<button type="submit" class="btn btn-default"><?php echo $model->isNewRecord ?Yii::t('basic', 'Create') : 'Save';?>
</button>

<?php $this->endWidget(); ?>

</div><!-- form -->