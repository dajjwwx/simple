<?php
/* @var $this ProfileController */
/* @var $model Profile */
/* @var $form CActiveForm */
?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'profile-form-study',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'action'=>$this->createUrl('profile/info', array('id'=>Yii::app()->user->id,'#'=>'study')),
	'enableAjaxValidation'=>true,
	'htmlOptions'=>array(
		'class'=>'form-horizontal',
		'role'=>'form'
	)
)); ?>
	<div class="col-sm-6">
	<?php echo $form->errorSummary($model); ?>
	
	<div class="form-group">
		<?php echo $form->labelEx($model,'job',array('class'=>'col-sm-3 control-label')); ?>
		<div class="col-sm-9">
		<?php //echo $form->textField($model,'job',array('size'=>60,'maxlength'=>500,'class'=>'form-control','data-container'=>'body','data-trigger'=>'focus','placeholder'=>Yii::t('basic','Job'),'data-toggle'=>'popover','title'=>'Popover Title','data-content'=>'Hello world')); ?>
		</div>
		<?php echo $form->error($model,'job'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'companyname',array('class'=>'col-sm-3 control-label')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'companyname',array('size'=>60,'maxlength'=>200,'class'=>'form-control','placeholder'=>Yii::t('basic','Company Name'))); ?>
		</div>
		<?php echo $form->error($model,'companyname'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'companyaddress',array('class'=>'col-sm-3 control-label')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'companyaddress',array('size'=>60,'maxlength'=>500,'class'=>'form-control','placeholder'=>Yii::t('basic','Company Address'))); ?>
		</div>
		<?php echo $form->error($model,'companyaddress'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'university',array('class'=>'col-sm-3 control-label')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'university',array('class'=>'form-control','placeholder'=>Yii::t('basic','University'))); ?>
		</div>
		<?php echo $form->error($model,'university'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'highschool',array('class'=>'col-sm-3 control-label')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'highschool',array('class'=>'form-control','placeholder'=>Yii::t('basic','High School'))); ?>
		</div>
		<?php echo $form->error($model,'highschool'); ?>
	</div>	

	<div class="form-group">
		<?php echo $form->labelEx($model,'middleschool',array('class'=>'col-sm-3 control-label')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'middleschool',array('class'=>'form-control','placeholder'=>Yii::t('basic','Middle School'))); ?>
		</div>
		<?php echo $form->error($model,'middleschool'); ?>
	</div>	
	
	<div class="form-group">
		<?php echo $form->labelEx($model,'primaryschool',array('class'=>'col-sm-3 control-label')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'primaryschool',array('class'=>'form-control','placeholder'=>Yii::t('basic','Primary School'))); ?>
		</div>
		<?php echo $form->error($model,'primaryschool'); ?>
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