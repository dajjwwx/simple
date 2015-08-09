<?php
/* @var $this PaperController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Papers',
);

$this->menu=array(
	array('label'=>'Create Paper', 'url'=>array('create')),
	array('label'=>'Manage Paper', 'url'=>array('admin')),
);
?>

<h1>Papers</h1>

<div class="panel panel-default">
	<div class="panel-heading">
		<span class="glyphicon glyphicon-paperclip"></span> <?php echo Yii::t('basic','Recent Updates');?></div>
	<div class="panel-body">
		<ul>
		<?php $this->widget('zii.widgets.CListView', array(
			'dataProvider'=>$dataProvider,
			'itemView'=>'_view',
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
		</ul>				
	</div>
</div>