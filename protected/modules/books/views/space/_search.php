<?php
/* @var $this SpaceController */
/* @var $model Books */
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
		<?php //echo $form->label($model,'origin_title'); ?>
		<?php echo $form->textField($model,'origin_title',array('size'=>60,'maxlength'=>128,'class'=>'form-control','placeholder'=>'origin_title')); ?>
	</div>

	<div class="form-group col-md-2">
		<?php //echo $form->label($model,'subtitle'); ?>
		<?php echo $form->textField($model,'subtitle',array('size'=>50,'maxlength'=>50,'class'=>'form-control','placeholder'=>'subtitle')); ?>
	</div>

	<div class="form-group col-md-2">
		<?php //echo $form->label($model,'pubdate'); ?>
		<?php echo $form->textField($model,'pubdate',array('class'=>'form-control','placeholder'=>'pubdate')); ?>
	</div>

	<div class="form-group col-md-2">
		<?php //echo $form->label($model,'isbn10'); ?>
		<?php echo $form->textField($model,'isbn10',array('size'=>60,'maxlength'=>255,'class'=>'form-control','placeholder'=>'isbn10')); ?>
	</div>

	<div class="form-group col-md-2">
		<?php //echo $form->label($model,'isbn13'); ?>
		<?php echo $form->textField($model,'isbn13',array('size'=>32,'maxlength'=>32,'class'=>'form-control','placeholder'=>'isbn13')); ?>
	</div>

	<div class="form-group col-md-2">
		<?php //echo $form->label($model,'author'); ?>
		<?php echo $form->textField($model,'author',array('size'=>60,'maxlength'=>128,'class'=>'form-control','placeholder'=>'author')); ?>
	</div>

	<div class="form-group col-md-2">
		<?php //echo $form->label($model,'image'); ?>
		<?php echo $form->textField($model,'image',array('size'=>60,'maxlength'=>256,'class'=>'form-control','placeholder'=>'image')); ?>
	</div>

	<div class="form-group col-md-2">
		<?php //echo $form->label($model,'summary'); ?>
		<?php echo $form->textArea($model,'summary',array('rows'=>6, 'cols'=>50,'class'=>'form-control','placeholder'=>'summary')); ?>
	</div>

	<div class="form-group col-md-2">
		<?php //echo $form->label($model,'tags'); ?>
		<?php echo $form->textField($model,'tags',array('size'=>60,'maxlength'=>255,'class'=>'form-control','placeholder'=>'tags')); ?>
	</div>

	<div class="form-group col-md-2">
		<?php //echo $form->label($model,'catelog'); ?>
		<?php echo $form->textArea($model,'catelog',array('rows'=>6, 'cols'=>50,'class'=>'form-control','placeholder'=>'catelog')); ?>
	</div>

	<div class="form-group col-md-2">
		<?php //echo $form->label($model,'binding'); ?>
		<?php echo $form->textField($model,'binding',array('size'=>16,'maxlength'=>16,'class'=>'form-control','placeholder'=>'binding')); ?>
	</div>

	<div class="form-group col-md-2">
		<?php //echo $form->label($model,'translator'); ?>
		<?php echo $form->textField($model,'translator',array('size'=>60,'maxlength'=>128,'class'=>'form-control','placeholder'=>'translator')); ?>
	</div>

	<div class="form-group col-md-2">
		<?php //echo $form->label($model,'pages'); ?>
		<?php echo $form->textField($model,'pages',array('class'=>'form-control','placeholder'=>'pages')); ?>
	</div>

	<div class="form-group col-md-2">
		<?php //echo $form->label($model,'publisher'); ?>
		<?php echo $form->textField($model,'publisher',array('size'=>60,'maxlength'=>128,'class'=>'form-control','placeholder'=>'publisher')); ?>
	</div>

	<div class="form-group col-md-2">
		<?php //echo $form->label($model,'alt_title'); ?>
		<?php echo $form->textField($model,'alt_title',array('size'=>60,'maxlength'=>255,'class'=>'form-control','placeholder'=>'alt_title')); ?>
	</div>

	<div class="form-group col-md-2">
		<?php //echo $form->label($model,'author_intro'); ?>
		<?php echo $form->textArea($model,'author_intro',array('rows'=>6, 'cols'=>50,'class'=>'form-control','placeholder'=>'author_intro')); ?>
	</div>

	<div class="form-group col-md-2">
		<?php //echo $form->label($model,'price'); ?>
		<?php echo $form->textField($model,'price',array('size'=>10,'maxlength'=>10,'class'=>'form-control','placeholder'=>'price')); ?>
	</div>


	<button type="submit" class="btn btn-default">Search</button>

<?php $this->endWidget(); ?>

<!-- search-form -->