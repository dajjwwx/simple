<?php
/* @var $this ProfileController */
/* @var $model Profile */
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
		<?php echo $form->textField($model,'id',array('class'=>'form-control','placeholder'=>'id')); ?>
	</div>

	<div class="form-group col-md-2">
		<?php //echo $form->label($model,'uid'); ?>
		<?php echo $form->textField($model,'uid',array('class'=>'form-control','placeholder'=>'uid')); ?>
	</div>

	<div class="form-group col-md-2">
		<?php //echo $form->label($model,'firstname'); ?>
		<?php echo $form->textField($model,'firstname',array('size'=>20,'maxlength'=>20,'class'=>'form-control','placeholder'=>'firstname')); ?>
	</div>

	<div class="form-group col-md-2">
		<?php //echo $form->label($model,'lastname'); ?>
		<?php echo $form->textField($model,'lastname',array('size'=>50,'maxlength'=>50,'class'=>'form-control','placeholder'=>'lastname')); ?>
	</div>

	<div class="form-group col-md-2">
		<?php //echo $form->label($model,'nickname'); ?>
		<?php echo $form->textField($model,'nickname',array('size'=>50,'maxlength'=>50,'class'=>'form-control','placeholder'=>'nickname')); ?>
	</div>

	<div class="form-group col-md-2">
		<?php //echo $form->label($model,'avatar'); ?>
		<?php echo $form->textField($model,'avatar',array('size'=>60,'maxlength'=>256,'class'=>'form-control','placeholder'=>'avatar')); ?>
	</div>

	<div class="form-group col-md-2">
		<?php //echo $form->label($model,'gender'); ?>
		<?php echo $form->textField($model,'gender',array('class'=>'form-control','placeholder'=>'gender')); ?>
	</div>

	<div class="form-group col-md-2">
		<?php //echo $form->label($model,'calendar'); ?>
		<?php echo $form->textField($model,'calendar',array('class'=>'form-control','placeholder'=>'calendar')); ?>
	</div>

	<div class="form-group col-md-2">
		<?php //echo $form->label($model,'birth'); ?>
		<?php echo $form->textField($model,'birth',array('size'=>50,'maxlength'=>50,'class'=>'form-control','placeholder'=>'birth')); ?>
	</div>

	<div class="form-group col-md-2">
		<?php //echo $form->label($model,'birthyear'); ?>
		<?php echo $form->textField($model,'birthyear',array('size'=>4,'maxlength'=>4,'class'=>'form-control','placeholder'=>'birthyear')); ?>
	</div>

	<div class="form-group col-md-2">
		<?php //echo $form->label($model,'birthmonth'); ?>
		<?php echo $form->textField($model,'birthmonth',array('size'=>2,'maxlength'=>2,'class'=>'form-control','placeholder'=>'birthmonth')); ?>
	</div>

	<div class="form-group col-md-2">
		<?php //echo $form->label($model,'birthday'); ?>
		<?php echo $form->textField($model,'birthday',array('size'=>2,'maxlength'=>2,'class'=>'form-control','placeholder'=>'birthday')); ?>
	</div>

	<div class="form-group col-md-2">
		<?php //echo $form->label($model,'blood'); ?>
		<?php echo $form->textField($model,'blood',array('size'=>10,'maxlength'=>10,'class'=>'form-control','placeholder'=>'blood')); ?>
	</div>

	<div class="form-group col-md-2">
		<?php //echo $form->label($model,'marry'); ?>
		<?php echo $form->textField($model,'marry',array('class'=>'form-control','placeholder'=>'marry')); ?>
	</div>

	<div class="form-group col-md-2">
		<?php //echo $form->label($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>100,'class'=>'form-control','placeholder'=>'email')); ?>
	</div>

	<div class="form-group col-md-2">
		<?php //echo $form->label($model,'phone'); ?>
		<?php echo $form->textField($model,'phone',array('size'=>50,'maxlength'=>50,'class'=>'form-control','placeholder'=>'phone')); ?>
	</div>

	<div class="form-group col-md-2">
		<?php //echo $form->label($model,'qq'); ?>
		<?php echo $form->textField($model,'qq',array('class'=>'form-control','placeholder'=>'qq')); ?>
	</div>

	<div class="form-group col-md-2">
		<?php //echo $form->label($model,'alipay'); ?>
		<?php echo $form->textField($model,'alipay',array('size'=>60,'maxlength'=>100,'class'=>'form-control','placeholder'=>'alipay')); ?>
	</div>

	<div class="form-group col-md-2">
		<?php //echo $form->label($model,'job'); ?>
		<?php echo $form->textField($model,'job',array('size'=>60,'maxlength'=>500,'class'=>'form-control','placeholder'=>'job')); ?>
	</div>

	<div class="form-group col-md-2">
		<?php //echo $form->label($model,'companyname'); ?>
		<?php echo $form->textField($model,'companyname',array('size'=>60,'maxlength'=>200,'class'=>'form-control','placeholder'=>'companyname')); ?>
	</div>

	<div class="form-group col-md-2">
		<?php //echo $form->label($model,'companyaddress'); ?>
		<?php echo $form->textField($model,'companyaddress',array('size'=>60,'maxlength'=>500,'class'=>'form-control','placeholder'=>'companyaddress')); ?>
	</div>

	<div class="form-group col-md-2">
		<?php //echo $form->label($model,'primaryschool'); ?>
		<?php echo $form->textField($model,'primaryschool',array('class'=>'form-control','placeholder'=>'primaryschool')); ?>
	</div>

	<div class="form-group col-md-2">
		<?php //echo $form->label($model,'middleschool'); ?>
		<?php echo $form->textField($model,'middleschool',array('class'=>'form-control','placeholder'=>'middleschool')); ?>
	</div>

	<div class="form-group col-md-2">
		<?php //echo $form->label($model,'highschool'); ?>
		<?php echo $form->textField($model,'highschool',array('class'=>'form-control','placeholder'=>'highschool')); ?>
	</div>

	<div class="form-group col-md-2">
		<?php //echo $form->label($model,'university'); ?>
		<?php echo $form->textField($model,'university',array('class'=>'form-control','placeholder'=>'university')); ?>
	</div>

	<div class="form-group col-md-2">
		<?php //echo $form->label($model,'country'); ?>
		<?php echo $form->textField($model,'country',array('size'=>50,'maxlength'=>50,'class'=>'form-control','placeholder'=>'country')); ?>
	</div>

	<div class="form-group col-md-2">
		<?php //echo $form->label($model,'province'); ?>
		<?php echo $form->textField($model,'province',array('class'=>'form-control','placeholder'=>'province')); ?>
	</div>

	<div class="form-group col-md-2">
		<?php //echo $form->label($model,'manicipal'); ?>
		<?php echo $form->textField($model,'manicipal',array('class'=>'form-control','placeholder'=>'manicipal')); ?>
	</div>

	<div class="form-group col-md-2">
		<?php //echo $form->label($model,'village'); ?>
		<?php echo $form->textField($model,'village',array('class'=>'form-control','placeholder'=>'village')); ?>
	</div>

	<div class="form-group col-md-2">
		<?php //echo $form->label($model,'county'); ?>
		<?php echo $form->textField($model,'county',array('class'=>'form-control','placeholder'=>'county')); ?>
	</div>

	<div class="form-group col-md-2">
		<?php //echo $form->label($model,'homeprovince'); ?>
		<?php echo $form->textField($model,'homeprovince',array('class'=>'form-control','placeholder'=>'homeprovince')); ?>
	</div>

	<div class="form-group col-md-2">
		<?php //echo $form->label($model,'homemanicipal'); ?>
		<?php echo $form->textField($model,'homemanicipal',array('class'=>'form-control','placeholder'=>'homemanicipal')); ?>
	</div>

	<div class="form-group col-md-2">
		<?php //echo $form->label($model,'homecounty'); ?>
		<?php echo $form->textField($model,'homecounty',array('class'=>'form-control','placeholder'=>'homecounty')); ?>
	</div>

	<div class="form-group col-md-2">
		<?php //echo $form->label($model,'homevillage'); ?>
		<?php echo $form->textField($model,'homevillage',array('class'=>'form-control','placeholder'=>'homevillage')); ?>
	</div>

	<div class="form-group col-md-2">
		<?php //echo $form->label($model,'addressdetail'); ?>
		<?php echo $form->textField($model,'addressdetail',array('size'=>60,'maxlength'=>200,'class'=>'form-control','placeholder'=>'addressdetail')); ?>
	</div>

	<div class="form-group col-md-2">
		<?php //echo $form->label($model,'homeaddressdetail'); ?>
		<?php echo $form->textField($model,'homeaddressdetail',array('size'=>60,'maxlength'=>200,'class'=>'form-control','placeholder'=>'homeaddressdetail')); ?>
	</div>


	<button type="submit" class="btn btn-default">Search</button>

<?php $this->endWidget(); ?>

<!-- search-form -->