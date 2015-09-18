<div class="row" style="height:160px;">
	<div class="col-md-2">
		<a href="<?php echo Yii::app()->createUrl('/books/shelf/view',array('id'=>$data->id));?>">
			<img class="thumbnail" src="<?php echo $data->info->image;?>" alt="" style="margin: auto;height:110px;margin-top:5px;margin-bottom:5px;">	
		</a>
	</div>
	<div class="col-md-7">
		<h4><?php echo CHtml::link(CHtml::encode($data->info->title), array('/books/shelf/view', 'id'=>$data->id)); ?></h4>
		<p><?php echo $data->shelf->name;?></p>
	</div>
	<div class="col-md-3">
		<p>当前库存：199本</p>
	</div>
	<hr class="clearfix" />
</div>
