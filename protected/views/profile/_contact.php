<?php
/* @var $this ProfileController */
/* @var $model Profile */
/* @var $form CActiveForm */
?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'profile-form-contact',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'action'=>$this->createUrl('profile/info', array('id'=>Yii::app()->user->id,'#'=>'contact')),
	'enableAjaxValidation'=>true,
	'htmlOptions'=>array(
		'class'=>'form-horizontal',
		'role'=>'form'
	)
)); ?>
	<div class="col-sm-6">
	<?php echo $form->errorSummary($model); ?>

	<div class="form-group">
		<?php echo $form->labelEx($model,'email',array('class'=>'col-sm-3 control-label')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>100,'class'=>'form-control','placeholder'=>Yii::t('basic','Email'))); ?>
		</div>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'phone',array('class'=>'col-sm-3 control-label')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'phone',array('size'=>50,'maxlength'=>50,'class'=>'form-control','placeholder'=>Yii::t('basic','Phone'))); ?>
		</div>
		<?php echo $form->error($model,'phone'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'qq',array('class'=>'col-sm-3 control-label')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'qq',array('class'=>'form-control','placeholder'=>Yii::t('basic','QQ'))); ?>
		</div>
		<?php echo $form->error($model,'qq',array('class'=>'col-sm-3 control-label')); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'alipay',array('class'=>'col-sm-3 control-label')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'alipay',array('size'=>60,'maxlength'=>100,'class'=>'form-control','placeholder'=>Yii::t('basic','Alipay'))); ?>
		</div>
		<?php echo $form->error($model,'alipay'); ?>
	</div>
	
	<div class="form-group">
	    <div class="col-sm-offset-3 col-sm-9">
	     	<button type="submit" class="btn btn-primary"><?php echo $model->isNewRecord ? 'Created' : 'Save';?></button>
	    </div>
 	 </div>	
	</div>
	<div class="col-sm-6">

	</div>
<?php $this->endWidget(); ?>
<!-- form -->