<?php
/* @var $this GaokaoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	$this->module->t('gaokao','Gaokao')=>array('space/index'),
	$viewname
);

$this->menu=array(
	array('label'=>'Create Gaokao', 'url'=>array('create')),
	array('label'=>'Manage Gaokao', 'url'=>array('admin')),
);
?>

<div class="panel panel-default">
	<div class="panel-heading">
		<span class="glyphicon glyphicon-paperclip"></span> <?php echo Yii::t('basic','Recent Updates');?></div>
	<div class="panel-body">
		<ul style="margin:0px;padding:0px;">
		<?php if($model):?>
		<?php foreach($model as $data):?>
			 <li style="list-style:none;float:left;width:180px;height:100px;margin:10px;padding:5px;background-color:#FFFFFF;border:1px solid grey;">

				<div style="margin-top:10px;text-align:center;font-size:18px;font-weight:bold;">
					<a href="/gaokao/coursepaper/update.html?id=<?php echo $data->id;?>">
						<?php echo $data->year;?><?php echo Gaokao::model()->getCourseName($data->course);?><?php echo $data->paper->name; ?>
					</a>
				</div>
				
				<br>
				<div style="text-align:center;font-size:16px;">
					<span>试题</span>&nbsp;&nbsp;&nbsp;&nbsp;<span>答案</span>				
				</div>
			</li>

		<?php endforeach;?>
		<?php else: ?>		
			<?php 
				$courses = Gaokao::model()->getCourses();
				$chunks = array_chunk($courses, 6);
			?>	
			<?php foreach($chunks[0] as $course):?>
				<li style="list-style:none;float:left;width:180px;height:100px;margin:10px;padding:5px;background-color:#FFFFFF;border:1px solid grey;">
					<div style="margin-top:10px;text-align:center;font-size:18px;font-weight:bold;">
						<a href="/gaokao/coursepaper/update.html?id=<?php echo $data->id;?>">
							<?php echo Gaokao::model()->getCourseName($data->course);?>
						</a>
									<?php echo $paper->year;?>年<?php echo $paper->name; ?><br />
									<?php echo $course['course'];?>
					</div>					
					<div style="text-align:center;font-size:16px;">
						<span>试题</span>&nbsp;&nbsp;&nbsp;&nbsp;<span>答案</span>				
					</div>
				</li>
			<?php endforeach;?>
		<?php endif;?>	
		</ul>		
	</div>
</div>



