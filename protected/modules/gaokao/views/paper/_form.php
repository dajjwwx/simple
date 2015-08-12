<?php
/* @var $this PaperController */
/* @var $model Paper */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'paper-form',
	'enableAjaxValidation'=>true,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="form-group">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>50,'maxlength'=>50,'class'=>"form-control",'placeholder'=>$this->module->t('gaokao','Name'))); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'year'); ?>
		<?php echo $form->dropDownList($model,'year',Gaokao::model()->getYearsList(),array('class'=>"form-control",'placeholder'=>$this->module->t('gaokao','Year'))); ?>
		<?php echo $form->error($model,'year'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'provinces'); ?>
		<?php foreach(Gaokao::model()->getProvinces() as $k=>$province):?>
			<span class="item"><a href="javascript:void(0);" class="provinceItem" onclick="YKG.app('form').multiChoice($(this),'Paper_provinces');" id="<?php echo $k; ?>"><?php echo $province; ?></a></span> | 
		<?php endforeach;?>
		<?php echo $form->textField($model,'provinces',array('size'=>50,'maxlength'=>50,'class'=>"form-control",'placeholder'=>$this->module->t('gaokao','Province'))); ?>
		<?php echo $form->error($model,'provinces'); ?>
	</div>

	<div class="form-group buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('basic','Submit') : Yii::t('basic','Save'),array('class'=>'btn btn-default')); ?>
	</div>

	<hr class="clearfix" />

	<div id="paperload" class="row"></div>


<?php $this->endWidget(); ?>

</div><!-- form -->

<script type="text/javascript">

$(function(){



	// loadPaper('2015');

	$("#Paper_year").click(function(){

		loadPaper($(this).val());
	});

	

	$("#paper-form").submit(function(){
		var params = $(this).serializeArray();

		console.log(params);

		$.post('/gaokao/paper/create.html',params,function(data){

			if(data.status == 'fail'){
				alert(data.message);
			}else{
				$("#paperload").load('/gaokao/paper/list.html?year='+$("#Paper_year").val());
			}			

		},'json');

		return false;

	});
});

function loadPaper(year)
{
	$("#paperload").load('/gaokao/paper/list.html?year='+year);
}


//暂留下，已经被替换为YKG.app('form').multiChoice(object,input)
function addIds(object){
	if(object.parent().hasClass('selected')){
		object.parent().removeClass('selected');
		object.parent().css({border:'none'});
	}else{
		object.parent().addClass('selected');
		object.parent().css({border:'1px solid grey'});
	}
	var result = '';
	$('.selected a').each(function(i){
		result = result + $(this).attr('id') + ',';
	});
	
	result = result.substring(0,result.length-1);
	
	$("#Paper_provinces").val(result);

	var params = {
		'provinces':object.attr('id'),
		'name':$("#Paper_name").val(),
		'year':$("#Paper_year").val()
	};

	// $.get('/gaokao/space/checkpaperexists.html',params,function(data){
	// 	if(data == 1){
	// 		alert('已经存在');
	// 		$("#mulitplefileuploader").parent().hide();
	// 	}else{
	// 		$("#mulitplefileuploader").parent().show();
	// 	}
	// });

	// $.get('/gaokao/space/paperitems.html',params,function(data){
	// 	//加载已经上传试卷
	// 	$("#uploadPapers").html(data);
	// });
}

</script>