<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
	<div class="container">
	
		<div class="row" style="margin-top:90px;opacity:0.9;">
			<h1>高考真题库</h1>
		</div>
	
		<div class="row" style="margin-top:30px;opacity:0.9;">
			<div class="col-md-3" style="position:relative;height:600px;">
				<div class="panel panel-default">
					<div class="panel-heading">
						<span class="glyphicon glyphicon-paperclip"></span> View Profile </div>
					<div class="panel-body">
										
						<ul class="list-group">
							<li class="list-group-item"><?php echo CHtml::link('高考真题库',array('space/list'));?></li>
							<li class="list-group-item"><?php echo CHtml::link('上传试题',array('space/addpaper'));?></li>
						</ul>
					
						<?php
							$this->beginWidget('zii.widgets.CPortlet', array(
								'title'=>'Operations',
							));
							$this->widget('zii.widgets.CMenu', array(
								'items'=>$this->menu,
								'htmlOptions'=>array('class'=>'operations list-group'),
							));
							$this->endWidget();
						?>		
					</div>
				</div>
				
				<div class="panel panel-default">
					<div class="panel-heading">
						<span class="glyphicon glyphicon-paperclip"></span> 科目
					</div>
					<div class="panel-body">
						<?php $this->widget('gaokao.components.gaokaomenu.GaokaoMenu',array(
							'view'=>'courseslist'
						)); ?>
					</div>
				</div>
				
				<div class="panel panel-default">
					<div class="panel-heading">
						<span class="glyphicon glyphicon-paperclip"></span> 年份
					</div>
					<div class="panel-body">
						<?php $this->widget('gaokao.components.gaokaomenu.GaokaoMenu',array(
							'view'=>'years'
						)); ?>
					</div>
				</div>
								
				<div class="panel panel-default">
					<div class="panel-heading">
						<span class="glyphicon glyphicon-paperclip"></span> 省份
					</div>
					<div class="panel-body">
						<?php $this->widget('gaokao.components.gaokaomenu.GaokaoMenu',array(
							'view'=>'province'
						)); ?>
					</div>
				</div>
			
				<div class="panel panel-default">
					<div class="panel-heading"><?php echo Yii::app()->getModule('gaokao')->t('gaokao','College Entrance Examination');?></div>
					<div class="panel-body">
						<div class=" widget">
						<?php
									
						?>				
						</div>
					</div>
				</div>	
			</div>
			<div class="col-md-9">
				<?php if(isset($this->breadcrumbs)):?>
						<?php $this->widget('application.components.BootBreadcrumbs', array(
							'links'=>$this->breadcrumbs,
							'homeLink'=>'<li>'.CHtml::link(Yii::t('zii','Home'),'/').'</li>'
						)); ?><!-- breadcrumbs -->
					<?php endif?> 
				<?php echo $content;?>
				<div class="col-md-4">
				</div>
				<div class="col-md-5">

				</div>
			</div>	
		</div>
		
		<script type="text/javascript">
		
		</script>
	</div>
<?php $this->endContent(); ?>