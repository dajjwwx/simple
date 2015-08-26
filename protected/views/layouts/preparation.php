<?php /* @var $this Controller */ ?>

<?php $this->beginContent('//layouts/main'); ?>
	<style type="text/css">
		.view_info p{
			text-indent: 2em;
		}
		.view_info .province a{
			margin:0px 5px;
		}
	</style>
	<div class="container">
	
		<div class="row" style="margin-top:70px;opacity:0.9;">
			<div class="col-md-4">
				<h1>
					<img src="/public/image/preparation/logo.png" />
					<span class="small">				
						<?php if($this->action->id == 'space') echo Gaokao::model()->getCourseName(intval($_GET['id'])); ?>
					</span>

				</h1>

			</div>
			<div class="col-md-4">&nbsp;</div>
			<div class="col-md-4" style="text-align:right;">
				<br />
				<br />
				<div class="input-group">
			      	<input type="text" class="form-control" placeholder="Search for...">
			      	<span class="input-group-btn">
			        	<button class="btn btn-default" type="button">Go!</button>
			      	</span>
			    </div><!-- /input-group -->
			</div>
		</div>
	
		<div class="row" style="margin-top:30px;opacity:0.9;">
			<div class="col-md-3" style="position:relative;height:600px;">
				<?php if(!Yii::app()->user->isGuest):?>
				<div class="panel panel-default">
					<div class="panel-heading">
						<span class="glyphicon glyphicon-paperclip"></span> 基本操作 </div>
					<div class="panel-body">										
						<ul class="list-group">
							<li class="list-group-item"><?php echo CHtml::link('备课本',array('space/list'));?></li>
							<li class="list-group-item"><?php echo CHtml::link('上传课件',array('space/create'));?></li>
							<?php if(Yii::app()->user->name == 'admin'):?>
							<li class="list-group-item"><?php echo CHtml::link('添加章节目录',array('catalog/create'));?></li>
							<li class="list-group-item"><?php echo CHtml::link('添加特殊试卷',array('coursepaper/create'));?></li>
							<?php endif;?>
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
				<?php endif;?>

				<div class="panel panel-default">
					<div class="panel-heading">
						<span class="glyphicon glyphicon-paperclip"></span> 科目
					</div>
					<div class="panel-body">
						<?php 
						$this->widget('preparation.components.menu.PreparationMenu',array(
							'view'=>'course'
						)); 
						?>
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
	</div>

	<!-- Modal -->

<?php $this->endContent(); ?>