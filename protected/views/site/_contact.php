<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'contact-form',
	'enableClientValidation'=>true,
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
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('class'=>'form-control','placeholder'=>Yii::t('basic', 'Please tell us your real name'))); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('class'=>'form-control','placeholder'=>Yii::t('basic', 'Email'))); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'subject'); ?>
		<?php echo $form->textField($model,'subject',array('size'=>60,'maxlength'=>128,'class'=>'form-control','placeholder'=>Yii::t('basic', 'Subject'))); ?>
		<?php echo $form->error($model,'subject'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'body'); ?>
		<?php echo $form->textArea($model,'body',array('rows'=>6, 'cols'=>50,'class'=>'form-control','placeholder'=>Yii::t('basic', 'Please tell us your puzzle, we\'ll solve it as soon as possible, and left you <abbr title="Telphone Number">Tel</abbr>, Thanks !'))); ?>
		<?php echo $form->error($model,'body'); ?>
	</div>

	<?php if(CCaptcha::checkRequirements()): ?>
	<div class="form-group">
		<?php // echo $form->labelEx($model,'verifyCode'); ?>
		<?php $this->widget('CCaptcha'); ?>
		<?php echo $form->textField($model,'verifyCode',array('class'=>'form-control','placeholder'=>Yii::t('basic','Verification Code'))); ?>
		<div class="hint"><?php echo Yii::t('basic','Please enter the letters as they are shown in the image above.<br/>Letters are not case-sensitive.')?></div>
		<?php echo $form->error($model,'verifyCode'); ?>
	</div>
	<?php endif; ?>
	
	<button class="btn btn-default" type="submit"><?php echo Yii::t('basic', 'Submit');?></button>

<?php $this->endWidget(); ?>