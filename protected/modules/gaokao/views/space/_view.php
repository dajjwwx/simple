<?php
/* @var $this GaokaoController */
/* @var $data Gaokao */
?>

<div class="view_info">
	<h5><span class="glyphicon glyphicon-file" aria-hidden="true"></span>   <?php echo CHtml::link(CHtml::encode($data->file->name), array('view', 'id'=>$data->id)); ?></h5>

	<span class="item">
	<?php echo CHtml::encode($data->getAttributeLabel('course')); ?>: <?php echo CHtml::encode(Gaokao::model()->getCourseName($data->course)); ?>
	</span>	
	<span class="item">
	<?php echo CHtml::encode($data->getAttributeLabel('year')); ?>: <?php echo CHtml::encode($data->year); ?>
	</span>
	<span class="item province">
		适用<?php echo CHtml::encode($data->getAttributeLabel('province')); ?>:	<?php echo Gaokao::model()->getProvincesScope($data->papername->provinces); ?>
	</span>
	<span class="item">
		文件大小:	<?php echo CHtml::encode(UtilFileInfo::formatSize($data->file->size)); ?>
	</span>
	<span class="item">
		上传时间：<?php echo date('Y/m/d',$data->file->created);?>
	</span>
	<br />
	<hr />
</div>