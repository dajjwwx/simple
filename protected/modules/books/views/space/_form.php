<?php
/* @var $this SpaceController */
/* @var $model Books */
/* @var $form CActiveForm */
?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'books-form',
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
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>50,'maxlength'=>50,'class'=>'form-control','placeholder'=>'title')); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'origin_title'); ?>
		<?php echo $form->textField($model,'origin_title',array('size'=>60,'maxlength'=>128,'class'=>'form-control','placeholder'=>'origin_title')); ?>
		<?php echo $form->error($model,'origin_title'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'subtitle'); ?>
		<?php echo $form->textField($model,'subtitle',array('size'=>50,'maxlength'=>50,'class'=>'form-control','placeholder'=>'subtitle')); ?>
		<?php echo $form->error($model,'subtitle'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'pubdate'); ?>
		<?php echo $form->textField($model,'pubdate',array('class'=>'form-control','placeholder'=>'pubdate')); ?>
		<?php echo $form->error($model,'pubdate'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'isbn10'); ?>
		<?php echo $form->textField($model,'isbn10',array('size'=>60,'maxlength'=>255,'class'=>'form-control','placeholder'=>'isbn10')); ?>
		<?php echo $form->error($model,'isbn10'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'isbn13'); ?>
		<?php echo $form->textField($model,'isbn13',array('size'=>32,'maxlength'=>32,'class'=>'form-control','placeholder'=>'isbn13')); ?>
		<?php echo $form->error($model,'isbn13'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'author'); ?>
		<?php echo $form->textField($model,'author',array('size'=>60,'maxlength'=>128,'class'=>'form-control','placeholder'=>'author')); ?>
		<?php echo $form->error($model,'author'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'image'); ?>
		<?php //echo $form->textField($model,'image',array('size'=>60,'maxlength'=>256,'class'=>'form-control','placeholder'=>'image')); ?>
		<?php echo CHtml::image($model->image);?>
		<?php echo $form->error($model,'image'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'summary'); ?>
		<?php echo $form->textArea($model,'summary',array('rows'=>6, 'cols'=>50,'class'=>'form-control','placeholder'=>'summary')); ?>
		<?php echo $form->error($model,'summary'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'tags'); ?>
		<?php echo $form->textField($model,'tags',array('size'=>60,'maxlength'=>255,'class'=>'form-control','placeholder'=>'tags')); ?>
		<?php echo $form->error($model,'tags'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'catelog'); ?>
		<?php echo $form->textArea($model,'catelog',array('rows'=>6, 'cols'=>50,'class'=>'form-control','placeholder'=>'catelog')); ?>
		<?php echo $form->error($model,'catelog'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'binding'); ?>
		<?php echo $form->textField($model,'binding',array('size'=>16,'maxlength'=>16,'class'=>'form-control','placeholder'=>'binding')); ?>
		<?php echo $form->error($model,'binding'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'translator'); ?>
		<?php echo $form->textField($model,'translator',array('size'=>60,'maxlength'=>128,'class'=>'form-control','placeholder'=>'translator')); ?>
		<?php echo $form->error($model,'translator'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'pages'); ?>
		<?php echo $form->textField($model,'pages',array('class'=>'form-control','placeholder'=>'pages')); ?>
		<?php echo $form->error($model,'pages'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'publisher'); ?>
		<?php echo $form->textField($model,'publisher',array('size'=>60,'maxlength'=>128,'class'=>'form-control','placeholder'=>'publisher')); ?>
		<?php echo $form->error($model,'publisher'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'alt_title'); ?>
		<?php echo $form->textField($model,'alt_title',array('size'=>60,'maxlength'=>255,'class'=>'form-control','placeholder'=>'alt_title')); ?>
		<?php echo $form->error($model,'alt_title'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'author_intro'); ?>
		<?php echo $form->textArea($model,'author_intro',array('rows'=>6, 'cols'=>50,'class'=>'form-control','placeholder'=>'author_intro')); ?>
		<?php echo $form->error($model,'author_intro'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'price'); ?>
		<?php echo $form->textField($model,'price',array('size'=>10,'maxlength'=>10,'class'=>'form-control','placeholder'=>'price')); ?>
		<?php echo $form->error($model,'price'); ?>
	</div>

	<button type="submit" class="btn btn-default"><?php echo $model->isNewRecord ? 'Created' : 'Save';?>
</button>

<?php $this->endWidget(); ?>

</div><!-- form -->