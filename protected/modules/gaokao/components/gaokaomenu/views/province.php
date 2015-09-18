<?php foreach($provinces as $k=>$province):?>
	<span class="item"><?php echo CHtml::link($province,array('space/province','id'=>$k));?></span> | 
<?php endforeach;?>