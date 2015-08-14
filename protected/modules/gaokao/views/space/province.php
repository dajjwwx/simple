<?php
/* @var $this GaokaoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	$this->module->t('gaokao','Gaokao')=>array('space/index'),
	$viewname.$current_year.'年高考真题'
);

$this->menu=array(
	array('label'=>'Create Gaokao', 'url'=>array('create')),
	array('label'=>'Manage Gaokao', 'url'=>array('admin')),
);
?>
<div class="panel panel-default">
	<div class="panel-heading">
		<span class="glyphicon glyphicon-paperclip"></span> <?php echo $viewname.$current_year;?>年高考真题</div>
	<div class="panel-body">
		<blockquote>
		<p>高考年份</p>
		<footer>
			<?php foreach($years as $year):?>
				<?php echo CHtml::link($year.'年 / ',array('space/province','id'=>$_GET['id'],'year'=>$year));?>
			<?php endforeach;?>			
		</footer>
	</blockquote>
	<hr />
		<ul style="margin:0px;padding:0px;">
		<?php if($model):?>
			<?php foreach($model as $data):?>
				 <li style="list-style:none;float:left;width:180px;height:150px;margin:10px;padding:5px;background-color:#FFFFFF;border:1px solid grey;">

					<div style="margin-top:10px;text-align:center;font-size:18px;font-weight:bold;">
						<a href="/gaokao/coursepaper/update.html?id=<?php echo $data->id;?>"></a>
						<?php echo $data->year;?>年<br />
						<?php echo $data->coursepaper->name; ?><br />
						<?php echo Gaokao::model()->getCourseName($data->course);?><br />						
					</div>
					<div style="text-align:center;font-size:16px;">
						<br />
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
				<li style="list-style:none;float:left;width:180px;height:150px;margin:10px;padding:5px;background-color:#FFFFFF;border:1px solid grey;">
					<div style="margin-top:10px;text-align:center;font-size:18px;font-weight:bold;">
						<a href="/gaokao/coursepaper/update.html?id=<?php echo $data->id;?>">
							<?php echo Gaokao::model()->getCourseName($data->course);?>
						</a>
						<?php echo $current_year;?>年<br />
						<?php echo $paper->name; ?><br />
						<?php echo $course['course'];?>
					</div>					
					<div style="text-align:center;font-size:16px;"><br />
						<span>试题</span>&nbsp;&nbsp;&nbsp;&nbsp;<span>答案</span>				
					</div>
				</li>
			<?php endforeach;?>
		<?php endif;?>	
		</ul>		
	</div>
</div>



