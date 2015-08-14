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
			<p>高考科目</p>
			<footer>
				<?php foreach($courses as $course):?>
					<?php echo CHtml::link($course['course'],array('space/year','id'=>$current_year,'course'=>$course['id']));?> / 
				<?php endforeach;?>			
			</footer>
		</blockquote>
		<hr />
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
