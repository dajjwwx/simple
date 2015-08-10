<?php
/* @var $this CoursePaperController */
/* @var $model CoursePaper */
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
		<?php //echo $form->label($model,'province'); ?>
		<?php echo $form->textField($model,'province',array('class'=>'form-control','placeholder'=>'province')); ?>
	</div>

	<div class="form-group col-md-2">
		<?php //echo $form->label($model,'course'); ?>
		<?php echo $form->textField($model,'course',array('class'=>'form-control','placeholder'=>'course')); ?>
	</div>

	<div class="form-group col-md-2">
		<?php //echo $form->label($model,'paper'); ?>
		<?php echo $form->textField($model,'paper',array('class'=>'form-control','placeholder'=>'paper')); ?>
	</div>

	<div class="form-group col-md-2">
		<?php //echo $form->label($model,'year'); ?>
		<?php echo $form->textField($model,'year',array('size'=>4,'maxlength'=>4,'class'=>'form-control','placeholder'=>'year')); ?>
	</div>


	<button type="submit" class="btn btn-default">Search</button>

<?php $this->endWidget(); ?>

<!-- search-form -->