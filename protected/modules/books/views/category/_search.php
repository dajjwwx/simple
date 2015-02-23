<?php
/* @var $this CategoryController */
/* @var $model BookCategory */
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
		<?php echo $form->textField($model,'id',array('class'=>'form-control','placeholder'=>'id')); ?>
	</div>

	<div class="form-group col-md-2">
		<?php //echo $form->label($model,'pid'); ?>
		<?php echo $form->textField($model,'pid',array('class'=>'form-control','placeholder'=>'pid')); ?>
	</div>

	<div class="form-group col-md-2">
		<?php //echo $form->label($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('class'=>'form-control','placeholder'=>'name')); ?>
	</div>


	<button type="submit" class="btn btn-default">Search</button>

<?php $this->endWidget(); ?>

<!-- search-form -->