<?php
/* @var $this CommentController */
/* @var $model Comment */
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
		<?php //echo $form->label($model,'cid'); ?>
		<?php echo $form->textField($model,'cid',array('class'=>'form-control','placeholder'=>'cid')); ?>
	</div>

	<div class="form-group col-md-2">
		<?php //echo $form->label($model,'pid'); ?>
		<?php echo $form->textField($model,'pid',array('class'=>'form-control','placeholder'=>'pid')); ?>
	</div>

	<div class="form-group col-md-2">
		<?php //echo $form->label($model,'uid'); ?>
		<?php echo $form->textField($model,'uid',array('class'=>'form-control','placeholder'=>'uid')); ?>
	</div>

	<div class="form-group col-md-2">
		<?php //echo $form->label($model,'ctype'); ?>
		<?php echo $form->textField($model,'ctype',array('class'=>'form-control','placeholder'=>'ctype')); ?>
	</div>

	<div class="form-group col-md-2">
		<?php //echo $form->label($model,'status'); ?>
		<?php echo $form->textField($model,'status',array('class'=>'form-control','placeholder'=>'status')); ?>
	</div>

	<div class="form-group col-md-2">
		<?php //echo $form->label($model,'author'); ?>
		<?php echo $form->textField($model,'author',array('size'=>30,'maxlength'=>30,'class'=>'form-control','placeholder'=>'author')); ?>
	</div>

	<div class="form-group col-md-2">
		<?php //echo $form->label($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>50,'maxlength'=>50,'class'=>'form-control','placeholder'=>'email')); ?>
	</div>

	<div class="form-group col-md-2">
		<?php //echo $form->label($model,'website'); ?>
		<?php echo $form->textField($model,'website',array('size'=>50,'maxlength'=>50,'class'=>'form-control','placeholder'=>'website')); ?>
	</div>

	<div class="form-group col-md-2">
		<?php //echo $form->label($model,'agent'); ?>
		<?php echo $form->textField($model,'agent',array('size'=>60,'maxlength'=>255,'class'=>'form-control','placeholder'=>'agent')); ?>
	</div>

	<div class="form-group col-md-2">
		<?php //echo $form->label($model,'ip'); ?>
		<?php echo $form->textField($model,'ip',array('size'=>30,'maxlength'=>30,'class'=>'form-control','placeholder'=>'ip')); ?>
	</div>

	<div class="form-group col-md-2">
		<?php //echo $form->label($model,'content'); ?>
		<?php echo $form->textField($model,'content',array('size'=>60,'maxlength'=>255,'class'=>'form-control','placeholder'=>'content')); ?>
	</div>

	<div class="form-group col-md-2">
		<?php //echo $form->label($model,'pubdate'); ?>
		<?php echo $form->textField($model,'pubdate',array('class'=>'form-control','placeholder'=>'pubdate')); ?>
	</div>


	<button type="submit" class="btn btn-default">Search</button>

<?php $this->endWidget(); ?>

<!-- search-form -->