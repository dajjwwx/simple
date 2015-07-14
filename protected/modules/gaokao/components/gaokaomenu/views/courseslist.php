<?php for($i=0; $i < sizeof($courses); $i++):?>
	<span class="item"><?php echo CHtml::link($courses[$i]['course'],array('course','id'=>$courses[$i]['id']));?></span> | 
<?php endfor;?>