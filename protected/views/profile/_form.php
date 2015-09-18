<?php
/* @var $this ProfileController */
/* @var $model Profile */
/* @var $form CActiveForm */
?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'profile-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>true,
	'htmlOptions'=>array(
		'class'=>'form-horizontal',
		'role'=>'form'
	)
)); ?>
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
		<?php echo $form->labelEx($model,'email',array('class'=>'col-sm-3 control-label')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>100,'class'=>'form-control','placeholder'=>Yii::t('basic','Email'))); ?>
		</div>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'phone',array('class'=>'col-sm-3 control-label')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'phone',array('size'=>50,'maxlength'=>50,'class'=>'form-control','placeholder'=>Yii::t('basic','Phone'))); ?>
		</div>
		<?php echo $form->error($model,'phone'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'qq',array('class'=>'col-sm-3 control-label')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'qq',array('class'=>'form-control','placeholder'=>Yii::t('basic','QQ'))); ?>
		</div>
		<?php echo $form->error($model,'qq',array('class'=>'col-sm-3 control-label')); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'alipay',array('class'=>'col-sm-3 control-label')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'alipay',array('size'=>60,'maxlength'=>100,'class'=>'form-control','placeholder'=>Yii::t('basic','Alipay'))); ?>
		</div>
		<?php echo $form->error($model,'alipay'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'job',array('class'=>'col-sm-3 control-label')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'job',array('size'=>60,'maxlength'=>500,'class'=>'form-control','placeholder'=>Yii::t('basic','Job'))); ?>
		</div>
		<?php echo $form->error($model,'job'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'companyname',array('class'=>'col-sm-3 control-label')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'companyname',array('size'=>60,'maxlength'=>200,'class'=>'form-control','placeholder'=>Yii::t('basic','Company Name'))); ?>
		</div>
		<?php echo $form->error($model,'companyname'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'companyaddress',array('class'=>'col-sm-3 control-label')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'companyaddress',array('size'=>60,'maxlength'=>500,'class'=>'form-control','placeholder'=>Yii::t('basic','Company Address'))); ?>
		</div>
		<?php echo $form->error($model,'companyaddress'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'primaryschool',array('class'=>'col-sm-3 control-label')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'primaryschool',array('class'=>'form-control','placeholder'=>Yii::t('basic','Primary School'))); ?>
		</div>
		<?php echo $form->error($model,'primaryschool'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'middleschool',array('class'=>'col-sm-3 control-label')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'middleschool',array('class'=>'form-control','placeholder'=>Yii::t('basic','Middle School'))); ?>
		</div>
		<?php echo $form->error($model,'middleschool'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'highschool',array('class'=>'col-sm-3 control-label')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'highschool',array('class'=>'form-control','placeholder'=>Yii::t('basic','High School'))); ?>
		</div>
		<?php echo $form->error($model,'highschool'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'university',array('class'=>'col-sm-3 control-label')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'university',array('class'=>'form-control','placeholder'=>Yii::t('basic','University'))); ?>
		</div>
		<?php echo $form->error($model,'university'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'country',array('class'=>'col-sm-3 control-label')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'country',array('size'=>50,'maxlength'=>50,'class'=>'form-control','placeholder'=>Yii::t('basic','Country'))); ?>
		</div>
		<?php echo $form->error($model,'country'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'province',array('class'=>'col-sm-3 control-label')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'province',array('class'=>'form-control','placeholder'=>Yii::t('basic','Province'))); ?>
		</div>
		<?php echo $form->error($model,'province'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'manicipal',array('class'=>'col-sm-3 control-label')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'manicipal',array('class'=>'form-control','placeholder'=>Yii::t('basic','Manicipal'))); ?>
		</div>
		<?php echo $form->error($model,'manicipal'); ?>
	</div>
	
	<div class="form-group">
		<?php echo $form->labelEx($model,'county',array('class'=>'col-sm-3 control-label')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'county',array('class'=>'form-control','placeholder'=>Yii::t('basic','County'))); ?>
		</div>
		<?php echo $form->error($model,'county'); ?>
	</div>
	
	<div class="form-group">
		<?php echo $form->labelEx($model,'village',array('class'=>'col-sm-3 control-label')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'village',array('class'=>'form-control','placeholder'=>Yii::t('basic','Village'))); ?>
		</div>
		<?php echo $form->error($model,'village'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'addressdetail',array('class'=>'col-sm-3 control-label')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'addressdetail',array('size'=>60,'maxlength'=>200,'class'=>'form-control','placeholder'=>Yii::t('basic','Address Detail'))); ?>
		</div>
		<?php echo $form->error($model,'addressdetail'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'homeprovince',array('class'=>'col-sm-3 control-label')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'homeprovince',array('class'=>'form-control','placeholder'=>Yii::t('basic','Home Province'))); ?>
		</div>
		<?php echo $form->error($model,'homeprovince'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'homemanicipal',array('class'=>'col-sm-3 control-label')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'homemanicipal',array('class'=>'form-control','placeholder'=>Yii::t('basic','Home Manicipal'))); ?>
		</div>
		<?php echo $form->error($model,'homemanicipal'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'homecounty',array('class'=>'col-sm-3 control-label')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'homecounty',array('class'=>'form-control','placeholder'=>Yii::t('basic','Home County'))); ?>
		</div>
		<?php echo $form->error($model,'homecounty'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'homevillage',array('class'=>'col-sm-3 control-label')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'homevillage',array('class'=>'form-control','placeholder'=>Yii::t('basic','Home Village'))); ?>
		</div>
		<?php echo $form->error($model,'homevillage'); ?>
	</div>


	<div class="form-group">
		<?php echo $form->labelEx($model,'homeaddressdetail',array('class'=>'col-sm-3 control-label')); ?>
		<div class="col-sm-9">
		<?php echo $form->textField($model,'homeaddressdetail',array('size'=>60,'maxlength'=>200,'class'=>'form-control','placeholder'=>Yii::t('basic','Home Address Detail'))); ?>
		</div>
		<?php echo $form->error($model,'homeaddressdetail'); ?>
	</div>
	
	<div class="form-group">
	    <div class="col-sm-offset-3 col-sm-9">
	     	<button type="submit" class="btn btn-default"><?php echo $model->isNewRecord ? 'Created' : 'Save';?></button>
	    </div>
 	 </div>	
	</div>
	<div class="col-sm-6">
	Hello
	</div>
<?php $this->endWidget(); ?>
<!-- form -->