<?php
/* @var $this BookstoreController */

$this->breadcrumbs=array(
	'Bookstore',
);
?>
<div class="panel panel-default">
	<div class="panel-heading">
		<span class="glyphicon glyphicon-paperclip"></span> 我的书库<?php echo CHtml::link('创建书库',array('/books/space/cshelf'),array('class'=>'pull-right'));?>
	</div>
	<div class="panel-body">
		<div class="row">
			 <?php 
			 $this->widget('zii.widgets.CListView', array(
				'dataProvider'=>$dataProvider,
				'itemView'=>'_bookshelfview',
				'itemsCssClass'=>'table table-hover table-condensed clearfix',
				'pagerCssClass'=>'pull-right',
				'pager'=>array(
						'selectedPageCssClass'=>'active',
						'maxButtonCount'=>8,
						'header'=>'',
						'htmlOptions'=>array(
								'class'=>'pagination',
						)
				)
			)); ?> 
		</div>
	</div>
</div>
