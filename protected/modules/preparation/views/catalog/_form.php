<?php
/* @var $this CatalogController */
/* @var $model Catalog */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'catalog-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="form-group">
		<?php echo $form->labelEx($model,'course'); ?>
		<?php echo $form->dropDownList($model,'course',Catalog::model()->getCoursesList(),array('class'=>"form-control",'placeholder'=>$this->module->t('gaokao','Course'))); ?>
		<?php echo $form->error($model,'course'); ?>
	</div>
	
	<div class="form-group">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255,'class'=>"form-control",'placeholder'=>$this->module->t('preparation','Name'))); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>


	<div class="form-group">
		<?php echo $form->labelEx($model,'pid'); ?>
		<?php echo $form->textField($model,'pid',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'pid'); ?>
	</div>


	<div class="form-group buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'btn')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->