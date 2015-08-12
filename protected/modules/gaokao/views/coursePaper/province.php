<?php foreach($model as $data):?>
	<a href="/gaokao/coursepaper/update.html?id=<?php echo $data->id;?>"><?php echo Gaokao::model()->getCourseName($data->course);?></a>
	 => 
	 <?php echo Paper::model()->getPaperName($data->paper);?><br />
<?php endforeach;?>