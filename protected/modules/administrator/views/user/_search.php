<?php
/* @var $this UserController */
/* @var $model User */
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
		<?php echo $form->textField($model,'id',array('size'=>50,'maxlength'=>50,'class'=>'form-control','placeholder'=>Yii::t('basic','ID') )); ?>
	</div>

	<div class="form-group col-md-2">
		<?php //echo $form->label($model,'username'); ?>
		<?php echo $form->textField($model,'username',array('size'=>50,'maxlength'=>50,'class'=>'form-control','placeholder'=>Yii::t('basic','UserName') )); ?>
	</div>

	<div class="form-group col-md-2">
		<?php // echo $form->label($model,'role'); ?>
		<?php echo $form->textField($model,'role',array('class'=>'form-control','placeholder'=>Yii::t('basic','Role'))); ?>
	</div>

	<div class="form-group col-md-2">
		<?php //echo $form->label($model,'created'); ?>
		<?php echo $form->textField($model,'created',array('class'=>'form-control','placeholder'=>Yii::t('basic','Created'))); ?>
	</div>

	<div class="form-group col-md-2">
		<?php //echo $form->label($model,'lastlogin'); ?>
		<?php echo $form->textField($model,'lastlogin',array('class'=>'form-control','placeholder'=>Yii::t('basic','Lastlogin'))); ?>
	</div>
		
	<div class="col-md-2">
		<button type="submit" class="btn btn-primary"><?php echo Yii::t('basic','Search');?></button>
	</div>
	


<?php $this->endWidget(); ?>

<!-- search-form -->