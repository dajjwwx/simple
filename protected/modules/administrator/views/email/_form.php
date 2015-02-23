<?php
/* @var $this EmailController */
/* @var $model Email */
/* @var $form CActiveForm */
?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'email-form',
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

	<?php echo $this->module->t('admin','<p class="note">Fields with <span class="required">*</span> are required.</p>');?>

	<?php echo $form->errorSummary($model); ?>

	<div class="form-group">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>32,'maxlength'=>32,'class'=>'form-control','value'=>Yii::app()->name,'placeholder'=>Yii::t('basic', 'Name'))); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>128,'class'=>'form-control','placeholder'=>Yii::t('basic', 'Email'))); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'subject'); ?>
		<?php echo $form->textField($model,'subject',array('size'=>60,'maxlength'=>64,'class'=>'form-control','placeholder'=>Yii::t('basic', 'Subject'))); ?>
		<?php echo $form->error($model,'subject'); ?>
	</div>
	
	<div class="form-group">
		<?php echo $form->labelEx($model,'body'); ?>
		<!--style给定宽度可以影响编辑器的最终宽度-->
		<script type="text/plain" id="editor" style="width:100%">
			<?php echo $model->body; ?>
		</script>
		<?php echo $form->textArea($model,'body',array('rows'=>6, 'cols'=>50,'class'=>'form-control','placeholder'=>Yii::t('basic', 'Body'))); ?>
		<?php echo $form->error($model,'body'); ?>
	</div>

	<button type="submit" class="btn btn-primary"><?php echo $model->isNewRecord ? 'Created' : 'Save';?></button>

<?php $this->endWidget(); ?>
<!-- form -->
<?php 
	$this->widget('ext.ueditor.ueditorWidget',array(
			'id'=>'editor',
//			'initialContent' => '<span style="color:#ccc">欢迎使用ueditor</span>',
//			'initialStyle' => 'body{margin:8px;font-family:"宋体";font-size:16px;}',
			'elementPathEnabled' => true,
			'autoFloatEnabled'=>true,
			//'topOffset'=>30,
			//编辑器底部距离工具栏高度(如果参数大于等于编辑器高度，则设置无效)
			//'toolbarTopOffset'=>400,
			'minFrameHeight' => 320,
			'initialFrameHeight'=>320,
// 			'minFrameWidth'=>800,
			'minFrameWidth'=>'100%',
//			'autoClearinitialContent' => true,
			'imagePath' => '/',
			'textarea' => 'content',

			'autoHeightEnabled' => true,
// 			'toolbars'=>array(array('Undo','Redo','|','ForeColor','BackColor', 'Bold','Italic','Underline','JustifyLeft','JustifyCenter','JustifyRight','InsertImage','ImageNone','ImageLeft','ImageRight','ImageCenter' )),
	));	
?>