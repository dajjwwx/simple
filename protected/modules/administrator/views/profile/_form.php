<?php
/* @var $this ProfileController */
/* @var $model Profile */
/* @var $form CActiveForm */
?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'profile-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array(
		'class'=>'form',
		'role'=>'form'
	)
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="form-group">
		<?php echo $form->labelEx($model,'uid'); ?>
		<?php echo $form->textField($model,'uid',array('class'=>'form-control','placeholder'=>'uid')); ?>
		<?php echo $form->error($model,'uid'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'firstname'); ?>
		<?php echo $form->textField($model,'firstname',array('size'=>20,'maxlength'=>20,'class'=>'form-control','placeholder'=>'firstname')); ?>
		<?php echo $form->error($model,'firstname'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'lastname'); ?>
		<?php echo $form->textField($model,'lastname',array('size'=>50,'maxlength'=>50,'class'=>'form-control','placeholder'=>'lastname')); ?>
		<?php echo $form->error($model,'lastname'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'nickname'); ?>
		<?php echo $form->textField($model,'nickname',array('size'=>50,'maxlength'=>50,'class'=>'form-control','placeholder'=>'nickname')); ?>
		<?php echo $form->error($model,'nickname'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'avatar'); ?>
		<?php echo $form->textField($model,'avatar',array('size'=>60,'maxlength'=>256,'class'=>'form-control','placeholder'=>'avatar')); ?>
		<?php echo $form->error($model,'avatar'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'gender'); ?>
		<?php echo $form->textField($model,'gender',array('class'=>'form-control','placeholder'=>'gender')); ?>
		<?php echo $form->error($model,'gender'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'calendar'); ?>
		<?php echo $form->textField($model,'calendar',array('class'=>'form-control','placeholder'=>'calendar')); ?>
		<?php echo $form->error($model,'calendar'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'birth'); ?>
		<?php echo $form->textField($model,'birth',array('size'=>50,'maxlength'=>50,'class'=>'form-control','placeholder'=>'birth')); ?>
		<?php echo $form->error($model,'birth'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'birthyear'); ?>
		<?php echo $form->textField($model,'birthyear',array('size'=>4,'maxlength'=>4,'class'=>'form-control','placeholder'=>'birthyear')); ?>
		<?php echo $form->error($model,'birthyear'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'birthmonth'); ?>
		<?php echo $form->textField($model,'birthmonth',array('size'=>2,'maxlength'=>2,'class'=>'form-control','placeholder'=>'birthmonth')); ?>
		<?php echo $form->error($model,'birthmonth'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'birthday'); ?>
		<?php echo $form->textField($model,'birthday',array('size'=>2,'maxlength'=>2,'class'=>'form-control','placeholder'=>'birthday')); ?>
		<?php echo $form->error($model,'birthday'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'blood'); ?>
		<?php echo $form->textField($model,'blood',array('size'=>10,'maxlength'=>10,'class'=>'form-control','placeholder'=>'blood')); ?>
		<?php echo $form->error($model,'blood'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'marry'); ?>
		<?php echo $form->textField($model,'marry',array('class'=>'form-control','placeholder'=>'marry')); ?>
		<?php echo $form->error($model,'marry'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>100,'class'=>'form-control','placeholder'=>'email')); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'phone'); ?>
		<?php echo $form->textField($model,'phone',array('size'=>50,'maxlength'=>50,'class'=>'form-control','placeholder'=>'phone')); ?>
		<?php echo $form->error($model,'phone'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'qq'); ?>
		<?php echo $form->textField($model,'qq',array('class'=>'form-control','placeholder'=>'qq')); ?>
		<?php echo $form->error($model,'qq'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'alipay'); ?>
		<?php echo $form->textField($model,'alipay',array('size'=>60,'maxlength'=>100,'class'=>'form-control','placeholder'=>'alipay')); ?>
		<?php echo $form->error($model,'alipay'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'job'); ?>
		<?php echo $form->textField($model,'job',array('size'=>60,'maxlength'=>500,'class'=>'form-control','placeholder'=>'job')); ?>
		<?php echo $form->error($model,'job'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'companyname'); ?>
		<?php echo $form->textField($model,'companyname',array('size'=>60,'maxlength'=>200,'class'=>'form-control','placeholder'=>'companyname')); ?>
		<?php echo $form->error($model,'companyname'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'companyaddress'); ?>
		<?php echo $form->textField($model,'companyaddress',array('size'=>60,'maxlength'=>500,'class'=>'form-control','placeholder'=>'companyaddress')); ?>
		<?php echo $form->error($model,'companyaddress'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'primaryschool'); ?>
		<?php echo $form->textField($model,'primaryschool',array('class'=>'form-control','placeholder'=>'primaryschool')); ?>
		<?php echo $form->error($model,'primaryschool'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'middleschool'); ?>
		<?php echo $form->textField($model,'middleschool',array('class'=>'form-control','placeholder'=>'middleschool')); ?>
		<?php echo $form->error($model,'middleschool'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'highschool'); ?>
		<?php echo $form->textField($model,'highschool',array('class'=>'form-control','placeholder'=>'highschool')); ?>
		<?php echo $form->error($model,'highschool'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'university'); ?>
		<?php echo $form->textField($model,'university',array('class'=>'form-control','placeholder'=>'university')); ?>
		<?php echo $form->error($model,'university'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'country'); ?>
		<?php echo $form->textField($model,'country',array('size'=>50,'maxlength'=>50,'class'=>'form-control','placeholder'=>'country')); ?>
		<?php echo $form->error($model,'country'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'province'); ?>
		<?php echo $form->textField($model,'province',array('class'=>'form-control','placeholder'=>'province')); ?>
		<?php echo $form->error($model,'province'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'manicipal'); ?>
		<?php echo $form->textField($model,'manicipal',array('class'=>'form-control','placeholder'=>'manicipal')); ?>
		<?php echo $form->error($model,'manicipal'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'village'); ?>
		<?php echo $form->textField($model,'village',array('class'=>'form-control','placeholder'=>'village')); ?>
		<?php echo $form->error($model,'village'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'county'); ?>
		<?php echo $form->textField($model,'county',array('class'=>'form-control','placeholder'=>'county')); ?>
		<?php echo $form->error($model,'county'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'homeprovince'); ?>
		<?php echo $form->textField($model,'homeprovince',array('class'=>'form-control','placeholder'=>'homeprovince')); ?>
		<?php echo $form->error($model,'homeprovince'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'homemanicipal'); ?>
		<?php echo $form->textField($model,'homemanicipal',array('class'=>'form-control','placeholder'=>'homemanicipal')); ?>
		<?php echo $form->error($model,'homemanicipal'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'homecounty'); ?>
		<?php echo $form->textField($model,'homecounty',array('class'=>'form-control','placeholder'=>'homecounty')); ?>
		<?php echo $form->error($model,'homecounty'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'homevillage'); ?>
		<?php echo $form->textField($model,'homevillage',array('class'=>'form-control','placeholder'=>'homevillage')); ?>
		<?php echo $form->error($model,'homevillage'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'addressdetail'); ?>
		<?php echo $form->textField($model,'addressdetail',array('size'=>60,'maxlength'=>200,'class'=>'form-control','placeholder'=>'addressdetail')); ?>
		<?php echo $form->error($model,'addressdetail'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'homeaddressdetail'); ?>
		<?php echo $form->textField($model,'homeaddressdetail',array('size'=>60,'maxlength'=>200,'class'=>'form-control','placeholder'=>'homeaddressdetail')); ?>
		<?php echo $form->error($model,'homeaddressdetail'); ?>
	</div>

	<button type="submit" class="btn btn-default"><?php echo $model->isNewRecord ? 'Created' : 'Save';?>
</button>

<?php $this->endWidget(); ?>

</div><!-- form -->