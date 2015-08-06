<?php /* @var $this Controller */ ?>
<style type="text/css">
	.view_info p{
		text-indent: 2em;
	}
	.view_info .province a{
		margin:0px 5px;
	}
</style>
<?php $this->beginContent('//layouts/main'); ?>
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

	<!-- Modal -->
<button type="button" class="btn btn-primary" data-whatever="@yuekegu.com">Large modal</button>

<div class="modal fade bs-example-modal-lg" id="exampleModal" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Modal title</h4>
      </div>
      <div class="modal-body">
        <p>One fine body&hellip;</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

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
		new ShowModal({
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