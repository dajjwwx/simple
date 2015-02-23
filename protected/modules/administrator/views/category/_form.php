<?php
/* @var $this CategoryController */
/* @var $model Category */
/* @var $form CActiveForm */
?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'category-form',
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
		<?php echo $form->textField($model,'name',array('size'=>50,'maxlength'=>50,'class'=>'form-control','placeholder'=>$this->module->t('admin','Category Name'))); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'type'); ?>
		<?php echo $form->dropDownList($model,'type',Category::model()->generateCategoryTypeList(), array('onchange'=>'YKG.app("dom").generateCategoryDropdownListByType($(this).val(),"Category_pid",0);','class'=>'form-control','placeholder'=>$this->module->t('admin','Category Type'))); ?>
		<?php echo $form->error($model,'type'); ?>
	</div>
	
	<div class="form-group">
		<?php echo $form->labelEx($model,'pid'); ?>
			<?php $dropdownlist = Category::model()->generateCategoryDropdownList($model);?>
		<?php echo $form->dropDownList($model,'pid',$dropdownlist,array('class'=>'form-control','placeholder'=>$this->module->t('admin','Category Parent'))); ?>
		<?php echo $form->error($model,'pid'); ?>
	</div>
	
	<div class="form-group">
		<?php echo $form->labelEx($model,'weight'); ?>
		<?php echo $form->textField($model,'weight',array('class'=>'form-control','placeholder'=>$this->module->t('admin','Category Weight'))); ?>
		<?php echo $form->error($model,'weight'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textArea($model,'description',array('size'=>60,'maxlength'=>500,'class'=>'form-control','placeholder'=>$this->module->t('admin','Category Name'))); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>
	
	<button type="submit" class="btn btn-primary"><?php echo $model->isNewRecord ? 'Create' : 'Save';?></button>

<?php $this->endWidget(); ?>

<!-- form -->