<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>

	<div class="container">
		<div class="row" style="margin-top:60px;opacity:0.9;">
				<?php echo Profile::model()->getUserAvatar(Yii::app()->user->id,array('style'=>'margin-top:30px;opcity:0.9;','class'=>'img-circle','id'=>'profile_avatar'),80);?>
		</div>
		<div class="row"  style="margin-top:20px;opacity:0.9;">
			<div class="col-md-9">
				<div class="panel panel-default">
					<div class="panel-heading">
						<span class="glyphicon glyphicon-paperclip"></span> 个人资料
					</div>
					<div class="panel-body">
					<?php echo $content; ?>
					</div>
				</div>		
			</div>		
			<div class="col-md-3">
				<div class="panel panel-default">
					<div class="panel-heading">
						<span class="glyphicon glyphicon-paperclip"></span> View Profile #<?php echo $model->id; ?>
					</div>
					<div class="panel-body">
					
						<ul class="list-group">
							<li class="list-group-item">Hello</li>
							<li class="list-group-item">World</li>
						</ul>
					
						<?php
							$this->beginWidget('zii.widgets.CPortlet', array(
								'title'=>'Operations',
							));
							$this->widget('zii.widgets.CMenu', array(
								'items'=>$this->menu,
								'htmlOptions'=>array('class'=>'operations'),
							));
							$this->endWidget();
						?>		
					</div>
				</div>
			</div>
		</div>
	</div>	
	<script type="text/javascript">
		
		</script>
<?php $this->endContent(); ?>