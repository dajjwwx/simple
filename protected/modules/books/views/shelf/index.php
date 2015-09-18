<?php
/* @var $this BookstoreController */

$this->breadcrumbs=array(
	'Bookstore',
);
?>

<div class="row">
	 <?php 
	 $this->widget('zii.widgets.CListView', array(
		'dataProvider'=>$dataProvider,
		'itemView'=>'_bookshelfview',
	)); ?> 
</div>


<hr />
<?php echo CHtml::link('创建书库',array('bookstore/create'));?> 
