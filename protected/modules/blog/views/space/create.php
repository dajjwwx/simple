<?php
/* @var $this SpaceController */
/* @var $model Blog */

$this->breadcrumbs=array(
	Yii::t('blog','Blog')=>array('index'),
	Yii::t('blog','Create Blog'),
);

$this->menu=array(
	array('label'=>'List Blog', 'url'=>array('index')),
	array('label'=>'Manage Blog', 'url'=>array('admin')),
);
?>

<?php $e = isset($_GET['e'])?$_GET['e']:'';?>
<div class="panel panel-default">
	<div class="panel-heading">
		<h4><span class="glyphicon glyphicon-plus"></span> <?php echo Yii::t('blog','Create Blog');?></h4>
		<div class="btn-group col-md-3 col-md-offset-10 text-right" data-toggle="buttons" style="margin-top:-35px;">
			 <a class="btn  <?php echo $e == 'ue' ?'btn-primary ':'';?>" href="<?php echo $this->createUrl('space/create',array('e'=>'ue')); ?>" onclick="location.href=this.href;">UEditor</a>
			<a class="btn  <?php echo $e == 'md' ?'btn-primary':'';?>" href="<?php echo $this->createUrl('space/create',array('e'=>'md'));?>" onclick="location.href=this.href;">MdEditor</a>
		</div>		
	</div>
	<div class="panel-body">
		<?php if($e =='md'):?>
			<?php $this->renderPartial('_mdeditor', array('model'=>$model)); ?>	
		<?php else:?>
			<?php $this->renderPartial('_form', array('model'=>$model)); ?>	
		<?php endif;?>
	</div>
</div>



