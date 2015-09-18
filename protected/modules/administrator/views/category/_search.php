<?php
/* @var $this CategoryController */
/* @var $model Category */
/* @var $form CActiveForm */
?>


<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
	'htmlOptions'=>array(
		'class'=>'form row-fluid',
		'role'=>'form'
	)
)); ?>

	<div class="form-group col-md-2">
		<?php //echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id',array('class'=>'form-control','placeholder'=>'ID')); ?>
	</div>

	<div class="form-group col-md-2">
		<?php //echo $form->label($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>50,'maxlength'=>50,'class'=>'form-control','placeholder'=>$this->module->t('admin','Category Name'))); ?>
	</div>

	<div class="form-group col-md-2">
		<?php //echo $form->label($model,'weight'); ?>
		<?php echo $form->textField($model,'weight',array('size'=>50,'maxlength'=>50,'class'=>'form-control','placeholder'=>$this->module->t('admin','Category Weight'))); ?>
	</div>

	<div class="form-group col-md-2">
		<?php //echo $form->label($model,'type'); ?>
		<?php echo $form->textField($model,'type',array('size'=>50,'maxlength'=>50,'class'=>'form-control','placeholder'=>$this->module->t('admin','Category Type'))); ?>
	</div>

	<div class="form-group col-md-2">
		<?php //echo $form->label($model,'description'); ?>
		<?php echo $form->textField($model,'description',array('size'=>60,'maxlength'=>500,'class'=>'form-control','placeholder'=>$this->module->t('admin','Category Description'))); ?>
	</div>

	<div class="form-group col-md-2">
		<?php //echo $form->label($model,'pid'); ?>
		<?php echo $form->textField($model,'pid',array('size'=>50,'maxlength'=>50,'class'=>'form-control','placeholder'=>$this->module->t('admin','Category Parent'))); ?>
	</div>

	<div class="form-group col-md-2">
		<?php //echo $form->label($model,'uid'); ?>
		<?php echo $form->textField($model,'uid',array('size'=>50,'maxlength'=>50,'class'=>'form-control','placeholder'=>$this->module->t('admin','Owner'))); ?>
	</div>

	<div class="col-md-2">
		<button type="submit" class="btn btn-default">Search</button>
	</div>
	
<?php $this->endWidget(); ?>

<!-- search-form -->