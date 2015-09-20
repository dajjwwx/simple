<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
<div class="container">
	<div class="row" style="margin-top:60px;"></div>
	<div class="row-fluid">
		<div class="col-md-12">
			<?php if(isset($this->breadcrumbs)):?>
				<?php 
					// $this->widget('application.components.BootBreadcrumbs', array(
					// 	'links'=>$this->breadcrumbs,
					// 	'homeLink'=>'<li>'.CHtml::link(Yii::t('zii','Home'),'/').'</li>'
					// )); 
				?><!-- breadcrumbs -->
				<?php $this->widget('ext.jbreadcrumbs.jbreadcrumbsWidget',array(
					'links'=>$this->breadcrumbs
				));?>
			<?php endif?> 
			<hr style="margin:10px 0px;"/>
			<?php echo $content; ?>
		</div>

	</div>
</div>
<?php $this->endContent(); ?>