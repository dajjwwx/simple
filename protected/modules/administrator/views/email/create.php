<?php
/* @var $this EmailController */
/* @var $model Email */

$this->breadcrumbs=array(
	$this->module->t('admin','Feed Back')=>array('admin'),
	$this->module->t('admin','Send Message'),
);

$this->menu=array(
	array('label'=>'List Email', 'url'=>array('index')),
	array('label'=>'Manage Email', 'url'=>array('admin')),
);
?>
<div class="panel panel-default">
	<div class="panel-heading"><h4><span class="glyphicon glyphicon-plus"></span> <?php echo $this->module->t('admin','Send Message');?></h4></div>
	<div class="panel-body" style="padding:5px 0px 0px 0px;">
		<div class="row-fluid" >
			<div class="col-md-9">
				<?php $this->renderPartial('_form', array('model'=>$model)); ?>
			</div>
			<div class="col-md-3 bg-success">
			<ul>
				<li>Hello</li>
			</ul>
			</div>
		</div>
	</div>
</div>