<?php foreach($provinces as $k=>$province):?>
	<span class="item"><?php echo CHtml::link($province,array('province','id'=>$k));?></span> | 
<?php endforeach;?>