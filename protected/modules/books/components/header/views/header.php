<div class="col-md-6">			
	<div class="img-circle pull-left" style="background:url('<?php echo $image;?>') no-repeat center center;width:80px;height:80px;margin:auto;"></div>
	<h3 style="margin-left:100px;"><?php echo CHtml::link($shelf->name,array('/books/bookshelf/home/','id'=>$shelf->id));?></h3>
</div>