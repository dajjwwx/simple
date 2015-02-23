<?php
/* @var $this SpaceController */
/* @var $data Books */
?>

<div class="col-md-3" style="text-align:center;height:165px;">
	<a href="<?php echo Yii::app()->createUrl('/books/space/view',array('id'=>$data->id));?>"><img class="thumbnail" src="<?php echo $data->info->image;?>" alt="" style="margin: auto;height:110px;margin-top:5px;margin-bottom:5px;">	</a>
	<div style="height:15px;margin-top:-6px;"><?php echo CHtml::link(CHtml::encode($data->info->title), array('/books/space/view', 'id'=>$data->id)); ?></div>
</div>

<?php /*
<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->info->getAttributeLabel('title')); ?>:</b>
	<?php echo CHtml::encode($data->info->title); ?>
	<br />

	<b><?php echo CHtml::encode($data->info->getAttributeLabel('origin_title')); ?>:</b>
	<?php echo CHtml::encode($data->info->origin_title); ?>
	<br />

	<b><?php echo CHtml::encode($data->info->getAttributeLabel('subtitle')); ?>:</b>
	<?php echo CHtml::encode($data->info->subtitle); ?>
	<br />

	<b><?php echo CHtml::encode($data->info->getAttributeLabel('pubdate')); ?>:</b>
	<?php echo CHtml::encode($data->info->pubdate); ?>
	<br />

	<b><?php echo CHtml::encode($data->info->getAttributeLabel('isbn10')); ?>:</b>
	<?php echo CHtml::encode($data->info->isbn10); ?>
	<br />

	<b><?php echo CHtml::encode($data->info->getAttributeLabel('isbn13')); ?>:</b>
	<?php echo CHtml::encode($data->info->isbn13); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('author')); ?>:</b>
	<?php echo CHtml::encode($data->author); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('image')); ?>:</b>
	<?php echo CHtml::encode($data->image); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('summary')); ?>:</b>
	<?php echo CHtml::encode($data->summary); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tags')); ?>:</b>
	<?php echo CHtml::encode($data->tags); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('catelog')); ?>:</b>
	<?php echo CHtml::encode($data->catelog); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('binding')); ?>:</b>
	<?php echo CHtml::encode($data->binding); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('translator')); ?>:</b>
	<?php echo CHtml::encode($data->translator); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pages')); ?>:</b>
	<?php echo CHtml::encode($data->pages); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('publisher')); ?>:</b>
	<?php echo CHtml::encode($data->publisher); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('alt_title')); ?>:</b>
	<?php echo CHtml::encode($data->alt_title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('author_intro')); ?>:</b>
	<?php echo CHtml::encode($data->author_intro); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('price')); ?>:</b>
	<?php echo CHtml::encode($data->price); ?>
	<br />

	

</div>
*/ ?>