<?php
/* @var $this CoursepaperController */
/* @var $model Coursepaper */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'coursepaper-form',
	'enableAjaxValidation'=>true,
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
		<div>
		<?php foreach(Gaokao::model()->getProvinces() as $k=>$province):?>
			<span class="item <?php echo $model->province == $k?'selected':''; ?>" style="<?php echo $model->province==$k?'border:1px solid grey;':'';?>"><a href="javascript:void(0);" class="provinceItem" onclick="paperInfo($(this))" id="<?php echo $k; ?>"><?php echo $province; ?></a></span> | 
		<?php endforeach;?>
		<?php echo $form->hiddenField($model,'province',array('class'=>'form-control')); ?>
		</div>
		<?php echo $form->error($model,'province'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'course'); ?>
		<div>
			<?php foreach(Gaokao::model()->getCoursesList(true) as $key=>$course):?>
				<span class="item <?php echo $model->course == $key?'selected':''; ?>"  style="<?php echo $model->course==$key?'border:1px solid grey;':'';?>"><a href="javascript:void(0);" class="courseItem" onclick="YKG.app('form').singleChoice($(this),'CoursePaper_course');" id="<?php echo $key;?>"><?php echo $course;?></a></span>
			<?php endforeach;?>
			<?php echo $form->hiddenField($model,'course',array('class'=>'form-control')); ?>
		</div>
		<?php echo $form->error($model,'course'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'paper'); ?>
		<div id="loadPaper">
			<blockquote>
				<small>选择年份，加载试卷类型</small>
			</blockquote>
		</div>
		<?php echo $form->hiddenField($model,'paper',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'paper'); ?>
	</div>

	<div class="form-group buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('basic','Submit') : Yii::t('basic','Save'),array('class'=>'btn btn-default')); ?>
	</div>

	<hr />
	<div id="paperInfo">
		<blockquote>
			<small>此处将显示相关省份的各科用题</small>
		</blockquote>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<script type="text/javascript">

function paperInfo(object)
{
	YKG.app('form').singleChoice(object,'CoursePaper_province');

	$("#paperInfo").load('/gaokao/coursepaper/province.html?province='+$("#CoursePaper_province").val()+'&year='+$("#CoursePaper_year").val());
}

	$(function(){

		$("#loadPaper").load('/gaokao/coursepaper/paper.html?year='+$("#CoursePaper_year").val()+'&paper='+$("#CoursePaper_course").val());

		$("#CoursePaper_year").change(function(){
			$("#loadPaper").load('/gaokao/coursepaper/paper.html?year='+$(this).val()+'&paper='+$("#CoursePaper_course").val());
		});


		$("#coursepaper-form").submit(function(){

			var params = $(this).serializeArray();

			$.post('/gaokao/coursepaper/create.html',params,function(data){
				$("#paperInfo").html(data.result);

				if(data.status == 'success'){
					alert(data.message);
					$("#paperInfo").load('/gaokao/coursepaper/province.html?province='+$("#CoursePaper_province").val()+'&year='+$("#CoursePaper_year").val());
				}else{
					console.log(data.messages);
				}

			},'json');

			return false;
		});

	})

</script>