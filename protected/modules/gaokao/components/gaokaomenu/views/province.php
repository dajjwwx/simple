<?php foreach($provinces as $province=>$k):?>
	<span class="item"><?php echo CHtml::link($province,array('province','id'=>$k));?></span> | 
<?php endforeach;?>