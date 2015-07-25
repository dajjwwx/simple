<?php for($i=0; $i < sizeof($courses); $i++):?>
	<span class="item"><a href="#<?php echo $courses[$i]['cname']; ?>"><?php echo $courses[$i]['course'];?></a></span> | 
<?php endfor;?>