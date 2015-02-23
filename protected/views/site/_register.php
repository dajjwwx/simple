<?php
/* @var $this RegisterFormController */
/* @var $model RegisterForm */
/* @var $form CActiveForm */
?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'register-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// See class documentation of CActiveForm for details on this,
	// you need to use the performAjaxValidation()-method described there.
	'enableAjaxValidation'=>false,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
		'htmlOptions'=>array(
			'class'=>'form',
			'role'=>'form'
		)
	),
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="form-group">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('class'=>'form-control','placeholder'=>Yii::t('basic','Email'))); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password',array('class'=>'form-control','placeholder'=>Yii::t('basic','Password'))); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'repassword'); ?>
		<?php echo $form->passwordField($model,'repassword',array('class'=>'form-control','placeholder'=>Yii::t('basic','Repassword'))); ?>
		<?php echo $form->error($model,'repassword'); ?>
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
	
	<div class="form-group">
	  <div class="checkbox">
        <label>
         <?php echo $form->checkBox($model,'agree'); ?> <?php echo Yii::t('basic','Agreement');?>&nbsp;
        </label>
      </div>		
		<?php echo $form->error($model,'agree'); ?>
	</div>
		
	<button class="btn btn-default"><?php echo Yii::t('basic', 'Login in');?></button>
<?php $this->endWidget(); ?>
<!-- form -->