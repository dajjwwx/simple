<?php
/* @var $this DefaultController */

$this->breadcrumbs=array(
	$this->module->id,
);
?>
<!-- Recent Update BEGIN-->
<div class="panel panel-default">
	<div class="panel-heading">
		<span class="glyphicon glyphicon-paperclip"></span> <?php echo $this->module->t('books', 'Recent Updates');?> 
		<a href="<?php echo $this->createUrl('/books/shelf/recent');?>" class="pull-right"><?php echo $this->module->t('books','more');?></a>
	</div>
	<div class="panel-body">
	<div style="background:url(/public/image/books/breaker.png) 0px 5px repeat-y;">
		<div class="table table-hover table-condensed clearfix">
			<?php foreach ($hotbooks as $data):?>
				<?php $this->renderPartial('_bookview',array('data'=>$data));?>
			<?php endforeach;?>
		  </div>
	</div>
	</div>
</div>
<!-- Recent Update END-->

<!-- Hot Books BEGIN -->
<div class="panel panel-default">
	<div class="panel-heading">
		<span class="glyphicon glyphicon-paperclip"></span> <?php echo Yii::t('books', 'Recent Updates');?> 
		<a href="" class="pull-right"><?php echo Yii::t('books','more');?></a>
	</div>
	<div class="panel-body">
	<div style="background:url(/public/image/books/breaker.png) 0px 5px repeat-y;">
		<div class="table table-hover table-condensed clearfix">
			<?php foreach ($hotbooks as $data):?>
				<?php $this->renderPartial('_bookview',array('data'=>$data));?>
			<?php endforeach;?>
		  </div>
	</div>
	</div>
</div>
<!-- Hot Books END -->

<?php 
	//$this->widget('books.components.panels.HotBooksWidget');
?>

<?php 
	$this->widget('books.components.panels.ShelvesWidget',array(
		'name'=>'火爆书库',
));
?>
