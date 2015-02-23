<?php
/* @var $this ProfileController */
/* @var $model Profile */
/* @var $form CActiveForm */
?>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'profile-form-basic',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'action'=>$this->createUrl('profile/info', array('id'=>Yii::app()->user->id,'#'=>'basic')),
	'enableAjaxValidation'=>true,
	'htmlOptions'=>array(
		'class'=>'form-horizontal',
		'role'=>'form'
	)
)); ?>

<?php 
Yii::app()->clientScript->registerScript('archiver-form', "

	function addRegion(){
		$('#regionAdd').show();
	}
	
	function regionAdd(){
		if($('#regionField').val() != ''){
		
			$.post('{$this->createUrl('/region/createregion')}',{'region':$('#regionField').val(),'pid':$('#lastInputRegion').val()},function(data){			
				if(data == 'ok'){
					$('#regionNav a:last').trigger('click');
				}else{
					alert(data);
				}		
				$('#regionField').val('');	
			});
		} else {
			alert('地区名称不能为空');
		}
	}
	
	function showAddress(object)
	{
		var href=object.attr('data-href');
		$('#profileAddress').load(href);
		return false;
	}
",CClientScript::POS_HEAD);
?>
	<div class="col-sm-6">
	<?php echo $form->errorSummary($model); ?>

	<div class="form-group">
		<?php //echo $form->labelEx($model,'firstname',array('class'=>'col-sm-3 control-label')); ?>
		<label for="firstname" class="col-sm-3 control-label"><?php echo Yii::t('basic','Name');?></label>
		<div class="col-sm-9">
			<div class="input-group">
				<div class="input-group-addon">
					<?php echo $form->textField($model,'firstname',array('size'=>20,'maxlength'=>20,'class'=>'form-control','placeholder'=>Yii::t('basic','Firstname'))); ?>
					<?php echo $form->error($model,'firstname'); ?>
				</div>
				<div class="input-group-addon">
					<?php echo $form->textField($model,'lastname',array('size'=>50,'maxlength'=>50,'class'=>'form-control','placeholder'=>Yii::t('basic','Lastname'))); ?>
					<?php echo $form->error($model,'lastname'); ?>
				</div>
			</div>			
		</div>		
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'nickname',array('class'=>'col-sm-3 control-label')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'nickname',array('size'=>50,'maxlength'=>50,'class'=>'form-control','placeholder'=>Yii::t('basic','Nickname'))); ?>
		</div>
		<?php echo $form->error($model,'nickname'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'avatar',array('class'=>'col-sm-3 control-label')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'avatar',array('size'=>60,'maxlength'=>256,'class'=>'form-control','placeholder'=>Yii::t('basic','Avatar'))); ?>
		</div>
		<?php echo $form->error($model,'avatar'); ?>
	</div>
		
	<div class="form-group">
		<?php echo $form->labelEx($model,'calendar',array('class'=>'col-sm-3 control-label')); ?>
		<div class="col-sm-9">	
			<div class="btn-group" data-toggle="buttons">
			<?php foreach (Profile::model()->generateCalendarList() as $k=>$v):?>
			  <label class="btn btn-primary  <?php echo $model->calendar == $k ?'active':'';?>">
			    <input type="radio" value="<?php echo $k;?>" name="Profile[calendar]" id="Profile_calendar_<?php echo $k;?>" autocomplete="off" <?php echo $model->calendar == $k ?'checked':'';?>> <?php echo $v;;?>
			  </label>
			<?php endforeach;?>
			</div>		
		</div>
		<?php echo $form->error($model,'calendar'); ?>
	</div>	
	
	<div class="form-group">
		<?php echo $form->labelEx($model,'birth',array('class'=>'col-sm-3 control-label')); ?>
		<div class="col-sm-9">
			<?php 
				$this->widget('zii.widgets.jui.CJuiDatePicker', array(
				    'name'=>'Profile[birth]',
					'id'=>'Profile_birth',
					'value'=>$model->birth,
					'model'=>$model,				
				    // additional javascript options for the date picker plugin
				    'options'=>array(
				        'showAnim'=>'fold',
						'changeMonth'=>true,
						'changeYear'=>true,
						'yearRange'=>"1978:{date('Y')}",
						'navigationAsDateFormat'=>true,
						'showMonthAfterYear'=>true,
						
				    ),
			//	    'theme'=>'base'
				    'language'=>'zh-CN',
				    'htmlOptions'=>array(
				    	'value'=>date('m/d/Y'),
						'class'=>'form-control',
						'placeholder'=>'生日',
			//	        'style'=>'height:20px;'
				    ),
				));
			?>
		</div>
		
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'gender',array('class'=>'col-sm-3 control-label'));?>
		<div class="col-sm-9">
			<div class="btn-group" data-toggle="buttons">
			<?php foreach (Profile::model()->generateGenderList() as $k=>$v):?>
			  <label class="btn btn-primary  <?php echo $model->gender == $k ?'active':'';?>">
			    <input type="radio" value="<?php echo $k;?>" name="Profile[gender]" id="Profile_gender_<?php echo $k;?>" autocomplete="off" <?php echo $model->gender == $k ?'checked':'';?>> <?php echo $v;?>
			  </label>
			<?php endforeach;?>
			</div>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'blood',array('class'=>'col-sm-3 control-label')); ?>
		<div class="col-sm-9">
		<div class="btn-group" data-toggle="buttons">
		<?php foreach (Profile::model()->generateBloodList() as $k=>$v):?>
			  <label class="btn btn-primary  <?php echo $model->blood == $v ?'active':'';?>">
			    <input type="radio" value="<?php echo $v;?>" name="Profile[blood]" id="Profile_blood_<?php echo $v;?>" autocomplete="off" <?php echo $model->blood == $v ?'checked':'';?>> <?php echo $v;;?>
			  </label>
			<?php endforeach;?>
		</div>
		</div>
		<?php echo $form->error($model,'blood'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'marry',array('class'=>'col-sm-3 control-label')); ?>
		<div class="col-sm-9">
			<div class="btn-group" data-toggle="buttons">
			<?php foreach (Profile::model()->generateMarryList() as $k=>$v):?>
				  <label class="btn btn-primary  <?php echo $model->marry == $k ?'active':'';?>">
				    <input type="radio" value="<?php echo $k;?>" name="Profile[marry]" id="Profile_marry_<?php echo $k;?>" autocomplete="off" <?php echo $model->marry == $v ?'checked':'';?>> <?php echo $v;;?>
				  </label>
				<?php endforeach;?>
			</div>
		</div>
		<?php echo $form->error($model,'marry'); ?>
	</div>	
	
	<div class="form-group">
		<?php echo $form->labelEx($model,'addressdetail',array('class'=>'col-sm-3 control-label')); ?>
		<div class="col-sm-9" style="padding-top:6px;">
			<?php //echo $form->textField($model,'addressdetail',array('size'=>60,'maxlength'=>200,'class'=>'form-control','placeholder'=>Yii::t('basic','Address Detail'))); ?>
			<span id="addressHolder"><?php echo Profile::model()->getUserAddress(Yii::app()->user->id);?></span>
			<?php echo $form->hiddenField($model,'addressdetail');?>
			<span><a href="#" data-href="<?php echo $this->createUrl('regionaddress');?>" onclick="showAddress($(this));return false;">修改</a></span>
		</div>
		<?php echo $form->error($model,'addressdetail'); ?>
	</div>
	
	<div class="form-group">
		<?php echo $form->labelEx($model,'homeaddressdetail',array('class'=>'col-sm-3 control-label')); ?>
		<div class="col-sm-9" style="padding-top:6px;">
			<?php //echo $form->textField($model,'homeaddressdetail',array('size'=>60,'maxlength'=>200,'class'=>'form-control','placeholder'=>Yii::t('basic','Home Address Detail'))); ?>
			<span id="homeAddressHolder"><?php echo Profile::model()->getUserHomeAddress(Yii::app()->user->id);?></span>
			<?php echo $form->hiddenField($model,'homeaddressdetail');?>
			<span><a href="#" data-href="<?php echo $this->createUrl('regionhomeaddress');?>" onclick="showAddress($(this));return false;">修改</a></span>
		</div>
		<?php echo $form->error($model,'homeaddressdetail'); ?>
	</div>
	<div class="form-group">
	    <div class="col-sm-offset-3 col-sm-9">
	     	<button type="submit" class="btn btn-primary"><?php echo $model->isNewRecord ? Yii::t('basic','Created') : Yii::t('basic','Save');?></button>
	    </div>
 	 </div>	
	</div>
	<div class="col-sm-6">
		<div id="profileAddress"></div>
	</div>
<?php $this->endWidget(); ?>
<!-- form -->