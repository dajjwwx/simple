<?php
/* @var $this FileController */
/* @var $model File */
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
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="form-group col-md-2">
		<?php //echo $form->label($model,'pid'); ?>
		<?php echo $form->textField($model,'pid'); ?>
	</div>

	<div class="form-group col-md-2">
		<?php //echo $form->label($model,'status'); ?>
		<?php echo $form->textField($model,'status'); ?>
	</div>

	<div class="form-group col-md-2">
		<?php //echo $form->label($model,'iscomment'); ?>
		<?php echo $form->textField($model,'iscomment'); ?>
	</div>

	<div class="form-group col-md-2">
		<?php //echo $form->label($model,'hits'); ?>
		<?php echo $form->textField($model,'hits'); ?>
	</div>

	<div class="form-group col-md-2">
		<?php //echo $form->label($model,'islocal'); ?>
		<?php echo $form->textField($model,'islocal'); ?>
	</div>

	<div class="form-group col-md-2">
		<?php //echo $form->label($model,'server'); ?>
		<?php echo $form->textField($model,'server',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="form-group col-md-2">
		<?php //echo $form->label($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="form-group col-md-2">
		<?php //echo $form->label($model,'tag'); ?>
		<?php echo $form->textField($model,'tag',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="form-group col-md-2">
		<?php //echo $form->label($model,'type'); ?>
		<?php echo $form->textField($model,'type'); ?>
	</div>

	<div class="form-group col-md-2">
		<?php //echo $form->label($model,'owner'); ?>
		<?php echo $form->textField($model,'owner'); ?>
	</div>

	<div class="form-group col-md-2">
		<?php //echo $form->label($model,'created'); ?>
		<?php echo $form->textField($model,'created'); ?>
	</div>

	<div class="form-group col-md-2">
		<?php //echo $form->label($model,'size'); ?>
		<?php echo $form->textField($model,'size'); ?>
	</div>

	<div class="form-group col-md-2">
		<?php //echo $form->label($model,'ext'); ?>
		<?php echo $form->textField($model,'ext',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="form-group col-md-2">
		<?php //echo $form->label($model,'mine'); ?>
		<?php echo $form->textField($model,'mine',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="form-group col-md-2">
		<?php //echo $form->label($model,'links'); ?>
		<?php echo $form->textField($model,'links',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="form-group col-md-2">
		<?php //echo $form->label($model,'remark'); ?>
		<?php echo $form->textArea($model,'remark',array('rows'=>6, 'cols'=>50)); ?>
	</div>


	<button type="submit" class="btn btn-default">Search</button>

<?php $this->endWidget(); ?>

<!-- search-form -->