<?php for($i=0; $i < sizeof($courses); $i++):?>
	<span class="item"><a href="<?php echo Yii::app()->createUrl('gaokao/space/course',array('id'=>$courses[$i]['id'])); ?>"><?php echo $courses[$i]['course'];?></a></span> | 
<?php endfor;?>