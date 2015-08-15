<?php
/* @var $this GaokaoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	$this->module->t('gaokao','Gaokao')=>array('space/index'),
	$viewname.'年高考真题',
	$current_course
);

$this->menu=array(
	array('label'=>'Create Gaokao', 'url'=>array('create')),
	array('label'=>'Manage Gaokao', 'url'=>array('admin')),
);
?>
<blockquote>
	<ul class="list-unstyled" style="font-size:14px;line-height:1.5em;"><h4>筛选条件</h4>
		<li><span class="glyphicon glyphicon-minus" aria-hidden="true"></span> 年份：
			<?php foreach($years as $year):?>
				<?php echo CHtml::link($year.'年',array('space/index','id'=>$year,'course'=>$default_course));?> / 
			<?php endforeach;?>			
		</li>
		<li><span class="glyphicon glyphicon-minus" aria-hidden="true"></span> 科目：
			<?php foreach($courses as $course):?>
				<?php echo CHtml::link($course['course'],array('space/index','id'=>$default_year,'course'=>$course['id']));?> / 
			<?php endforeach;?>			
		</li>	
	</ul>		
</blockquote>

<div class="panel panel-default">
	<div class="panel-heading">
		<span class="glyphicon glyphicon-paperclip"></span> <?php echo $current_course;?></div>
	<div class="panel-body">
		<ul style="margin:0px;padding:0px;">
			<?php foreach($papernames as $data):?>
				<?php $this->renderPartial('_list',array(
					'id'=>$data->id,
					'year'=>$data->year,
					'name'=>$data->name,
					'course'=>$current_course,
					'paper'=>'<span>试题</span>&nbsp;&nbsp;&nbsp;&nbsp;<span>答案</span>'
				)); ?>


		<?php endforeach;?>
		</ul>				
	</div>
</div>
