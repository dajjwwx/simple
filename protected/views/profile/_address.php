<?php
/* @var $this ProfileController */
/* @var $model Profile */
/* @var $form CActiveForm */
?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'profile-form-address',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
		'action'=>$this->createUrl('profile/info', array('id'=>Yii::app()->user->id,'#'=>'address')),
	'enableAjaxValidation'=>true,
	'htmlOptions'=>array(
		'class'=>'form-horizontal',
		'role'=>'form'
	)
)); ?>
	<div class="col-sm-6">
	<?php echo $form->errorSummary($model); ?>
<!-- <div class="form-group">
		<?php echo $form->labelEx($model,'country',array('class'=>'col-sm-3 control-label')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'country',array('size'=>50,'maxlength'=>50,'class'=>'form-control','placeholder'=>Yii::t('basic','Country'))); ?>
		</div>
		<?php echo $form->error($model,'country'); ?>
	</div>
 -->		
	<div class="form-group">
		<?php echo $form->labelEx($model,'province',array('class'=>'col-sm-3 control-label')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'province',array('class'=>'form-control','placeholder'=>Yii::t('basic','Province'))); ?>
		</div>
		<?php echo $form->error($model,'province'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'manicipal',array('class'=>'col-sm-3 control-label')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'manicipal',array('class'=>'form-control','placeholder'=>Yii::t('basic','Manicipal'))); ?>
		</div>
		<?php echo $form->error($model,'manicipal'); ?>
	</div>
	
	<div class="form-group">
		<?php echo $form->labelEx($model,'county',array('class'=>'col-sm-3 control-label')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'county',array('class'=>'form-control','placeholder'=>Yii::t('basic','County'))); ?>
		</div>
		<?php echo $form->error($model,'county'); ?>
	</div>
	
	<div class="form-group">
		<?php echo $form->labelEx($model,'village',array('class'=>'col-sm-3 control-label')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'village',array('class'=>'form-control','placeholder'=>Yii::t('basic','Village'))); ?>
		</div>
		<?php echo $form->error($model,'village'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'addressdetail',array('class'=>'col-sm-3 control-label')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'addressdetail',array('size'=>60,'maxlength'=>200,'class'=>'form-control','placeholder'=>Yii::t('basic','Address Detail'))); ?>
		</div>
		<?php echo $form->error($model,'addressdetail'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'homeprovince',array('class'=>'col-sm-3 control-label')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'homeprovince',array('class'=>'form-control','placeholder'=>Yii::t('basic','Home Province'))); ?>
		</div>
		<?php echo $form->error($model,'homeprovince'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'homemanicipal',array('class'=>'col-sm-3 control-label')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'homemanicipal',array('class'=>'form-control','placeholder'=>Yii::t('basic','Home Manicipal'))); ?>
		</div>
		<?php echo $form->error($model,'homemanicipal'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'homecounty',array('class'=>'col-sm-3 control-label')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'homecounty',array('class'=>'form-control','placeholder'=>Yii::t('basic','Home County'))); ?>
		</div>
		<?php echo $form->error($model,'homecounty'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'homevillage',array('class'=>'col-sm-3 control-label')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'homevillage',array('class'=>'form-control','placeholder'=>Yii::t('basic','Home Village'))); ?>
		</div>
		<?php echo $form->error($model,'homevillage'); ?>
	</div>


	<div class="form-group">
		<?php echo $form->labelEx($model,'homeaddressdetail',array('class'=>'col-sm-3 control-label')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'homeaddressdetail',array('size'=>60,'maxlength'=>200,'class'=>'form-control','placeholder'=>Yii::t('basic','Home Address Detail'))); ?>
		</div>
		<?php echo $form->error($model,'homeaddressdetail'); ?>
	</div>
	
	<div class="form-group">
	    <div class="col-sm-offset-3 col-sm-9">
	     	<button type="submit" class="btn btn-primary"><?php echo $model->isNewRecord ? 'Created' : 'Save';?></button>
	    </div>
 	 </div>	
	</div>
	<div class="col-sm-6">
		<?php $this->renderPartial('__homeaddress');?>
	</div>
<?php $this->endWidget(); ?>
<!-- form -->