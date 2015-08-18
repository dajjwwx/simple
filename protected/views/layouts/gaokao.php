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
					<img src="/public/image/gaokao/logo.png" />
					<span class="small">
						<?php if($this->action->id == 'year') echo $_GET['id']; ?>
						<?php if($this->action->id == 'province') echo Region::model()->getRegion(intval($_GET['id'])); ?>
						<?php if($this->action->id == 'course') echo Gaokao::model()->getCourseName(intval($_GET['id'])); ?>
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
							<li class="list-group-item"><?php echo CHtml::link('高考真题库',array('space/list'));?></li>
							<li class="list-group-item"><?php echo CHtml::link('上传试题',array('space/create'));?></li>
							<?php if(Yii::app()->user->name == 'admin'):?>
							<li class="list-group-item"><?php echo CHtml::link('添加试卷类型',array('paper/create'));?></li>
							<li class="list-group-item"><?php echo CHtml::link('添加特殊试卷',array('coursepaper/create'));?></li>
							<?php endif;?>
						</ul>					
						<?php
							// $this->beginWidget('zii.widgets.CPortlet', array(
							// 	'title'=>'Operations',
							// ));
							// $this->widget('zii.widgets.CMenu', array(
							// 	'items'=>$this->menu,
							// 	'htmlOptions'=>array('class'=>'operations list-group'),
							// ));
							// $this->endWidget();
						?>		
					</div>
				</div>
				<?php endif;?>
				<!--
				<div class="panel panel-default">
					<div class="panel-heading">
						<span class="glyphicon glyphicon-paperclip"></span> 科目
					</div>
					<div class="panel-body">
						<?php 
						// $this->widget('gaokao.components.gaokaomenu.GaokaoMenu',array(
						// 	'view'=>'courseslist'
						// )); 
						?>
					</div>
				</div>
				-->
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
				<!--
				<div class="panel panel-default">
					<div class="panel-heading"><?php echo Yii::app()->getModule('gaokao')->t('gaokao','College Entrance Examination');?></div>
					<div class="panel-body">
						<div class=" widget">
						<?php
									
						?>				
						</div>
					</div>
				</div>	
				-->
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

	<!-- Modal -->
<button type="button" class="btn btn-primary" data-whatever="@yuekegu.com">Large modal</button>



<script type="text/javascript">
function ShowModal(data)
{
	this.id = data.id;
	this.title = data.title;
	this.body = data.body;

	this.showEvent = function(){
		return $("#"+this.id).on('show.bs.modal',function(event){
			data.showEvent(event);
		});
	};
	this.hideEvent = data.hideEvent;

	this.show = function(){
		
		$(".modal-title").html(this.title);
		$(".modal-body").html(this.body);

		$("#"+this.id).modal('show');

		return this;

	};


}

$(function(){
	$(".btn-primary").click(function(){

		YKG.app('bootstrap').showModal({
			'id':'exampleModal',
			'title':'Hello Title',
			'body':'Hello Body',
			'showEvent':function(event){

				console.log(event);

				var modal = $("#exampleModal");
				modal.find('.modal-footer>.btn-primary').click(function(){
					alert("HHHHH");
				});
			}
		}).show().showEvent();

	});
});

</script>

<?php $this->endContent(); ?>