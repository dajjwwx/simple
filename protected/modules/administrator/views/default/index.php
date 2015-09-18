<?php
/* @var $this DefaultController */

$this->breadcrumbs=array(
	$this->module->id,
);
?>
<div class="col-md-6">
	<?php $this->renderPartial('/default/_file');?>
</div>
<div class="col-md-4">
	<h1 class="page-header"><?php echo $this->uniqueId . '/' . $this->action->id; ?></h1>
	<p>
	This is the view content for action "<?php echo $this->action->id; ?>".
	The action belongs to the controller "<?php echo get_class($this); ?>"
	in the "<?php echo $this->module->id; ?>" module.
	</p>
	<p>
	You may customize this page by editing <tt><?php echo __FILE__; ?></tt>
	</p>
</div>
<div class="col-md-4">
	<?php $this->renderPartial('administrator.views.default._panel');?>
</div>
<div class="col-md-4">
	<?php $this->renderPartial('/default/_server');?>
</div>






