<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
	<?php foreach($courses as $course):?>
	<div class="panel panel-default">
		<div class="panel-heading">
			<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $course->cname; ?>" aria-expanded="false" aria-controls="collapse<?php echo $course->cname; ?>">
				<span class="glyphicon glyphicon-paperclip"></span> <?php echo $course->course;?>
			</a>
		</div>
		<div id="collapse<?php echo $course->cname;?>" class="panel-collapse collapse  <?php echo $_GET['course']==$course->cname?'in':'';?>" role="tabpanel" aria-labelledby="heading<?php echo $course->cname;?>">
			<div  class="panel-body">
				<?php //echo $_GET['course']; ?>
				<?php foreach($provinces as $province): ?>
				<div style="padding:10px;margin:5px;float:left;">
					<img src="/public/image/gaokao/paper.gif" style="width:120px;" alt="..." class="img-thumbnail">
					<br />
					<?php echo $province;?>
				</div>
				<?php endforeach;?>
			</div>
		</div>
	</div>
	<?php endforeach;?>
</div>