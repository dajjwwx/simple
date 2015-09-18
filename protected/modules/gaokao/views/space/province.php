<?php
/* @var $this GaokaoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	$this->module->t('gaokao','Gaokao')=>array('space/index'),
	$viewname.'高考真题'=>array('space/province','id'=>$_GET['id']),
	$current_year.'年'
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
			<?php echo CHtml::link($year.'年',array('space/province','id'=>$_GET['id'],'year'=>$year));?> / 
		<?php endforeach;?>			
	</li>
	<li><span class="glyphicon glyphicon-minus" aria-hidden="true"></span> 省份：
		<?php foreach($provinces as $k=>$province):?>
			<?php echo CHtml::link($province,array('space/province','id'=>$k,'year'=>$year));?> / 
		<?php endforeach;?>
	</li>
</ul>
</blockquote>

<div class="panel panel-default">
	<div class="panel-heading">
		<span class="glyphicon glyphicon-paperclip"></span> <?php echo $viewname.$current_year;?>年高考真题</div>
	<div class="panel-body">
		<ul style="margin:0px;padding:0px;">
		<?php if($model):?>
			<?php foreach($model as $data):?>
				<?php $this->renderPartial('_list',array(
					'id'=>$data->id,
					'year'=>$year,
					'name'=>$data->coursepaper->name,
					'course'=>Gaokao::model()->getCourseName($data->course),
					'paper'=>'<span>试题</span>&nbsp;&nbsp;&nbsp;&nbsp;<span>答案</span>'
				)); ?>
			<?php endforeach;?>
			<?php else: ?>	
			<?php if($paper):?>	
				<?php				
					$courses = Gaokao::model()->getCourses();
					$chunks = array_chunk($courses, 6);
				?>	
				<?php foreach($chunks[0] as $course):?>
					<?php $this->renderPartial('_list',array(
						'id'=>$data->id,
						'year'=>$current_year,
						'name'=>$paper->name,
						'course'=>$course['course'],
						'paper'=>'<span>试题</span>&nbsp;&nbsp;&nbsp;&nbsp;<span>答案</span>'
					)); ?>
				<?php endforeach;?>
			<?php endif;?>
		<?php endif;?>	
		</ul>		
	</div>
</div>



