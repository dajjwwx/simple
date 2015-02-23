<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
<div class="row-fluid">
	<div class="col-md-9">
		<?php echo $content; ?>
	</div>
	<div class="col-md-3">
		<h4 class="page-header">
			Sidebar
		</h4>
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
<?php $this->endContent(); ?>