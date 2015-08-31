<?php
/* @var $this SpaceController */
/* @var $model Preparation */

$this->breadcrumbs=array(
	'Preparations'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Preparation', 'url'=>array('index')),
	array('label'=>'Manage Preparation', 'url'=>array('admin')),
);
?>
<div class="panel panel-default">
	<div class="panel-heading"><?php echo Yii::app()->getModule('preparation')->t('preparations','Upload Preparation');?></div>
	<div class="panel-body">
		<div class=" widget">
			<blockquote>
				<p>这时上传课件,上传文件流程如下：</p>
				<small>选择科目-->选择课件所属目录-->上传课件-->提交数据</small>
			</blockquote>
			<div class="col-md-6">
				<h5>选择科目</h5>

				<?php $courses = Catalog::model()->getCourses();?>

				<?php for($i=0; $i < sizeof($courses); $i++):?>
					<span class="item">
						<a href="javascript:void(0);">
							<?php echo $courses[$i]['course'];?>
						</a>
				</span>  
				<?php endfor;?>

				<h5>选择章节</h5>
				<?php
					$this->widget('ext.treeview.TreeViewWidget',array(
			// 'link'=>''
					));			
				?>
			</div>
			<div class="col-md-6">
				<h5>上传课件</h5>
				<?php $this->renderPartial('_form', array('model'=>$model)); ?>
			</div>


			</div>
		</div>
	</div>
</div>	

