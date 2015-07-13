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
				
<div class="col-md-3" style="text-align:center;height:165px;">
	<a href="<?php echo Yii::app()->createUrl('/books/shelf/view',array('id'=>$data->id));?>"><img class="thumbnail" src="<?php echo $data->info->image;?>" alt="" style="margin: auto;height:110px;margin-top:25px;margin-bottom:5px;">	</a>
	<div style="height:15px;margin-top:-6px;"><?php echo CHtml::link(CHtml::encode($data->info->title), array('/books/shelf/view', 'id'=>$data->id)); ?></div>
</div>
				
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
