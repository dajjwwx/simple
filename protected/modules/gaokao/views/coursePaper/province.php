<?php if($model):?>
<?php foreach($model as $data):?>
	<a href="/gaokao/coursepaper/update.html?id=<?php echo $data->id;?>"><?php echo Gaokao::model()->getCourseName($data->course);?></a>
	 => 
	 <?php echo Paper::model()->getPaperName($data->paper);?><br />
<?php endforeach;?>
<?php else: ?>
	<?php 
		$courses = Gaokao::model()->getCourses();

		$chunks = array_chunk($courses, 6);
	?>
	
	<?php foreach($chunks[0] as $course):?>

		<?php echo $course['course'];?>=><?php echo $paper->name; ?><br />
	<?php endforeach;?>
<?php endif;?>