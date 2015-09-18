<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
		'htmlOptions'=>array(
			'class'=>'form',
			'role'=>'form'
		)
	),
)); ?>
	<?php //echo Yii::t('basic','<p class="note">Fields with <span class="required">*</span> are required.</p>');?>

	<div class="form-group">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username',array('class'=>'form-control','placeholder'=>Yii::t('basic','UserName'))); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password', array('class'=>'form-control','placeholder'=>Yii::t('basic','Password'))); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>

	<div class="form-group">
	  <div class="checkbox">
        <label>
         <?php echo $form->checkBox($model,'rememberMe'); ?> <?php echo Yii::t('basic','Remember me next time');?>&nbsp; | &nbsp;<a href="<?php echo $this->createUrl('/site/forgotpassword');?>" class="pull-right">忘记密码了？</a>
        </label>
      </div>		
		<?php echo $form->error($model,'rememberMe'); ?>
	</div>
	
	<button type="submit" class="btn btn-primary"><?php echo Yii::t('basic','Login');?></button>

<?php $this->endWidget(); ?>