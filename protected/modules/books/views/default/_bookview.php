<div class="col-md-3" style="text-align:center;height:165px;">
	<a href="<?php echo Yii::app()->createUrl('/books/shelf/view',array('id'=>$data->id));?>"><img class="thumbnail" src="<?php echo $data->info->image;?>" alt="" style="margin: auto;height:110px;margin-top:25px;margin-bottom:5px;">	</a>
	<div style="height:15px;margin-top:-6px;"><?php echo CHtml::link(CHtml::encode($data->info->title), array('/books/shelf/view', 'id'=>$data->id)); ?></div>
</div>