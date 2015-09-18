<?php
/* @var $this EmailController */
/* @var $model Email */
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
		<?php echo $form->textField($model,'id',array('class'=>'form-control col','placeholder'=>$this->module->t('admin','ID'))); ?>
	</div>

	<div class="form-group col-md-2">
		<?php //echo $form->label($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>32,'maxlength'=>32,'class'=>'form-control','placeholder'=>$this->module->t('admin','Name'))); ?>
	</div>

	<div class="form-group col-md-2">
		<?php //echo $form->label($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>128,'class'=>'form-control','placeholder'=>$this->module->t('admin','Email'))); ?>
	</div>

	<div class="form-group col-md-2">
		<?php //echo $form->label($model,'subject'); ?>
		<?php echo $form->textField($model,'subject',array('size'=>60,'maxlength'=>64,'class'=>'form-control','placeholder'=>$this->module->t('admin','Subject'))); ?>
	</div>

	<div class="form-group col-md-2">
		<?php //echo $form->label($model,'isread'); ?>
		<?php echo $form->textField($model,'isread',array('class'=>'form-control','placeholder'=>$this->module->t('admin','Has Read ?'))); ?>
	</div>

	<div class="form-group col-md-2">
		<?php //echo $form->label($model,'isreply'); ?>
		<?php echo $form->textField($model,'isreply',array('class'=>'form-control','placeholder'=>$this->module->t('admin','Has Reply ?'))); ?>
	</div>

	<div class="form-group col-md-2">
		<?php //echo $form->label($model,'reply'); ?>
		<?php echo $form->textField($model,'reply',array('class'=>'form-control','placeholder'=>$this->module->t('admin','Reply'))); ?>
	</div>
	
	<div class="form-group col-md-2">
		<?php //echo $form->label($model,'body'); ?>
		<?php echo $form->textField($model,'body',array('rows'=>6, 'cols'=>50,'class'=>'form-control','placeholder'=>$this->module->t('admin','Body'))); ?>
	</div>

	<div class="col-md-2">
		<button type="submit" class="btn btn-default"><?php echo $this->module->t('admin','Search');?></button>
	</div>
	

<?php $this->endWidget(); ?>
<!-- search-form -->
<hr />