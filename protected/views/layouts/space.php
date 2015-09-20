<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
<div class="container">
	<div class="row" style="margin-top:60px;margin-bottom:10px;">
		<div class="col-md-3 text-center">
			<br />
		</div>
		<div class="col-md-9"></div>
	</div>
	<div class="col-md-3">
		<div class="panel panel-default">
			<div class="panel-heading">
				<?php echo Profile::model()->getUserAvatar(Yii::app()->user->id,array('style'=>'margin-top:30px;opcity:0.9;','class'=>'img-circle','id'=>'profile_avatar'),80);?>
				&nbsp;&nbsp;<?php echo Yii::app()->user->name;?>
			</div>
			<div class="panel-body">
				<ul class="list-group">
					<li class="list-group-item"><?php echo CHtml::link('我的动态',array('space/create'));?></li>
					<li class="list-group-item"><?php echo CHtml::link('上传课件',array('space/create'));?></li>   


				</ul>	
			</div>
		</div>
	</div>
	<div class="col-md-9">
		<?php echo $content; ?>
	</div>
</div>
<?php $this->endContent(); ?>