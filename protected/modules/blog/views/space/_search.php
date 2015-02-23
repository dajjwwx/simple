<?php
/* @var $this SpaceController */
/* @var $model Blog */
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
		<?php //echo $form->label($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>50,'maxlength'=>50,'class'=>'form-control','placeholder'=>'title')); ?>
	</div>

	<div class="form-group col-md-2">
		<?php //echo $form->label($model,'iscomment'); ?>
		<?php echo $form->textField($model,'iscomment',array('class'=>'form-control','placeholder'=>'iscomment')); ?>
	</div>

	<div class="form-group col-md-2">
		<?php //echo $form->label($model,'isrecommend'); ?>
		<?php echo $form->textField($model,'isrecommend',array('class'=>'form-control','placeholder'=>'isrecommend')); ?>
	</div>

	<div class="form-group col-md-2">
		<?php //echo $form->label($model,'ctype'); ?>
		<?php echo $form->textField($model,'ctype',array('class'=>'form-control','placeholder'=>'ctype')); ?>
	</div>

	<div class="form-group col-md-2">
		<?php //echo $form->label($model,'author'); ?>
		<?php echo $form->textField($model,'author',array('class'=>'form-control','placeholder'=>'author')); ?>
	</div>

	<div class="form-group col-md-2">
		<?php //echo $form->label($model,'hits'); ?>
		<?php echo $form->textField($model,'hits',array('class'=>'form-control','placeholder'=>'hits')); ?>
	</div>

	<div class="form-group col-md-2">
		<?php //echo $form->label($model,'pubdate'); ?>
		<?php echo $form->textField($model,'pubdate',array('class'=>'form-control','placeholder'=>'pubdate')); ?>
	</div>

	<div class="form-group col-md-2">
		<?php //echo $form->label($model,'modify'); ?>
		<?php echo $form->textField($model,'modify',array('class'=>'form-control','placeholder'=>'modify')); ?>
	</div>

	<div class="form-group col-md-2">
		<?php //echo $form->label($model,'tags'); ?>
		<?php echo $form->textField($model,'tags',array('size'=>60,'maxlength'=>100,'class'=>'form-control','placeholder'=>'tags')); ?>
	</div>

	<div class="form-group col-md-2">
		<?php //echo $form->label($model,'status'); ?>
		<?php echo $form->textField($model,'status',array('class'=>'form-control','placeholder'=>'status')); ?>
	</div>

	<div class="form-group col-md-2">
		<?php //echo $form->label($model,'content'); ?>
		<?php echo $form->textArea($model,'content',array('rows'=>6, 'cols'=>50,'class'=>'form-control','placeholder'=>'content')); ?>
	</div>


	<button type="submit" class="btn btn-default">Search</button>

<?php $this->endWidget(); ?>

<!-- search-form -->