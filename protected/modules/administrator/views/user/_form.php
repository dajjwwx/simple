<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm */
?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
	'clientOptions'=>array(
			'validateOnSubmit'=>true,
			'htmlOptions'=>array(
					'class'=>'form',
					'role'=>'form'
			)
	),
)); ?>

	<?php echo Yii::t('basic','<p class="note">Fields with <span class="required">*</span> are required.</p>')?>

	<?php echo $form->errorSummary($model); ?>

	<div class="form-group">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username',array('size'=>50,'maxlength'=>50,(($this->action->id == 'update'||$this->action->id=='modifypassword')?'readonly':'')=>'readonly','class'=>'form-control','placeholder'=>Yii::t('basic', 'UserName'))); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>
	<?php if($this->action->id == 'update'||$this->action->id == 'create'):?>
	<div class="form-group">
		<?php echo $form->labelEx($model,'role'); ?>
		<?php echo $form->dropDownList($model,'role',User::model()->generateRoleList(), array('class'=>'form-control','placeholder'=>Yii::t('basic', 'Role'))); ?>
		<?php echo $form->error($model,'role'); ?>
	</div>
	<?php endif;?>
	

	<?php if($this->action->id == 'modifypassword'||$this->action->id == 'create'):?>
	<div class="form-group">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password',array('size'=>60,'maxlength'=>128,'class'=>'form-control','placeholder'=>Yii::t('basic', 'Password'))); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>
	<?php endif;?>

	<button type="submit" class="btn btn-primary"><?php echo $model->isNewRecord ? Yii::t('basic','Create') : Yii::t('basic','Save'); ?></button>

<?php $this->endWidget(); ?>

</div><!-- form -->