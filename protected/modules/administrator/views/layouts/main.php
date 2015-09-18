<?php $this->beginContent('/layouts/base');?>
	<?php require_once Yii::getPathOfAlias('administrator.views.layouts.nav').'.php';?>
	<div class="container-fluid">
		<div class="row-fluid">
			<div class="col-md-2 page-sidebar">
				<h1 ><span class="glyphicon glyphicon-th">控制面板</span></h1>
				<hr />
				<?php require_once Yii::getPathOfAlias('administrator.views.layouts.list').'.php';?>
			</div>
			<div class="col-md-10">			
				<?php if(isset($this->breadcrumbs)):?>
					<?php $this->widget('application.components.BootBreadcrumbs', array(
						'links'=>$this->breadcrumbs,
					)); ?><!-- breadcrumbs -->
				<?php endif?>   					
				<?php echo $content;?>
			</div>
		</div>
	</div>
<?php $this->endContent();?>
