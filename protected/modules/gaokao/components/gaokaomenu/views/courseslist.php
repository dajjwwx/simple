<?php for($i=0; $i < sizeof($courses); $i++):?>
	<span style="padding:5px;margin:10px;background-color:#FF83FA;line-height:1.5em;color:white;"><?php echo CHtml::link($courses[$i]['course'],array('course','id'=>$courses[$i]['id']));?></span> | 
<?php endfor;?>