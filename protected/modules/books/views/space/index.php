<?php
/* @var $this SpaceController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Books',
);

$this->menu=array(
	array('label'=>'Create Books', 'url'=>array('create')),
	array('label'=>'Manage Books', 'url'=>array('admin')),
);
?>


<div class="panel panel-default">
	<div class="panel-heading">
		<span class="glyphicon glyphicon-list"></span> 我的书籍
	</div>
	<div class="panel-body">
		<div style="background:url(/public/image/books/breaker.png) 0px 5px repeat-y;">
			<?php $this->widget('zii.widgets.CListView', array(
				'dataProvider'=>$dataProvider,
				'itemView'=>'_view',
				'itemsCssClass'=>'table table-hover table-condensed clearfix',
				'pagerCssClass'=>'pull-right clearfix',
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
<?php 
	$this->widget('books.components.panels.ShelvesWidget',array(
		'name'=>'我的书库',
		'id'=>Yii::app()->user->id,
		'link'=>'/books/space/home'
));
?>