<?php for($i=0; $i < sizeof($years); $i++):?>
	<span class="item"><?php echo CHtml::link($years[$i],array('space/index','id'=>$years[$i]));?></span> | 
<?php endfor;?>