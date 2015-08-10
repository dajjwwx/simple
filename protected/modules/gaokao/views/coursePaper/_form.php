<?php
/* @var $this CoursePaperController */
/* @var $model CoursePaper */
/* @var $form CActiveForm */
?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'course-paper-form',
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
		<?php echo $form->labelEx($model,'year'); ?>
		<?php echo $form->dropDownList($model,'year',Gaokao::model()->getYearsList(),array('class'=>"form-control",'placeholder'=>$this->module->t('gaokao','Year'))); ?>
		<?php echo $form->error($model,'year'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'province'); ?>
		<?php foreach(Gaokao::model()->getProvinces() as $k=>$province):?>
			<span class="item"><a href="javascript:void(0);" class="provinceItem" onclick="addId($(this),'CoursePaper_province');" id="<?php echo $k; ?>"><?php echo $province; ?></a></span> | 
		<?php endforeach;?>
		<?php echo $form->textField($model,'province',array('size'=>50,'maxlength'=>50,'class'=>"form-control",'placeholder'=>$this->module->t('gaokao','Province'))); ?>
		<?php echo $form->error($model,'province'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'course'); ?>
		<?php foreach(Gaokao::model()->getCoursesList(true) as $key=>$course):?>
			<span class="item"><a href="javascript:void(0);" class="courseItem" onclick="addId($(this),'CoursePaper_course');" id="<?php echo $key;?>"><?php echo $course;?></a></span>
		<?php endforeach;?>
		<?php echo $form->textField($model,'course',array('class'=>'form-control','placeholder'=>'course')); ?>
		<?php echo $form->error($model,'course'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'paper'); ?>
		<?php foreach(Paper::model()->getPapers('2015') as $paper):?>			
			<span class="item"><a href="javascript:void(0);" class="courseItem" onclick="addId($(this),'CoursePaper_paper');" id="<?php echo $paper->id;?>"><?php echo $paper->name;?></a></span>
		<?php endforeach;?>
		<?php echo $form->textField($model,'paper',array('class'=>'form-control','placeholder'=>'paper')); ?>
		<?php echo $form->error($model,'paper'); ?>
	</div>

	<button type="submit" class="btn btn-default"><?php echo $model->isNewRecord ? 'Created' : 'Save';?>
</button>

<?php $this->endWidget(); ?>

</div><!-- form -->

<script type="text/javascript">
	
	function addId(object,id)
	{
		object.parent().siblings().removeClass('selected').css({'border':'none'});

		if(object.parent().hasClass('selected')){
			object.parent().removeClass('selected').css({'border':'none'});
			$("#"+id).val('');
		}else{
			object.parent().addClass('selected').css({border:'1px solid grey'});
			$("#"+id).val(object.attr('id'));
		}
		

		
	}

</script>