<?php
/* @var $this SpaceController */
/* @var $model Preparation */

$this->breadcrumbs=array(
	Yii::app()->getModule('preparation')->t('preparation','Preparation')=>array('index'),
	Catalog::model()->getCourseName($model->catalog->course)=>array('space/course','id'=>$model-catalog->course),
	// $model->id=>array('view','id'=>$model->id),
	// 'Update',
);

$this->menu=array(
	array('label'=>'List Preparation', 'url'=>array('index')),
	array('label'=>'Create Preparation', 'url'=>array('create')),
	array('label'=>'View Preparation', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Preparation', 'url'=>array('admin')),
);

$menu = array_reverse(Catalog::model()->generateBreadcrumbs($model->cid, $model->catalog->course));

$this->breadcrumbs = array_merge($this->breadcrumbs,$menu);
$this->breadcrumbs = array_merge($this->breadcrumbs,array(UtilString::strSlice($model->file->name,0,50)));
?>

<div class="panel panel-default">
	<div class="panel-heading"><?php echo Yii::app()->getModule('preparation')->t('preparation','Update Preparation Information');?></div>
		<div class="panel-body">
			<div class="widget">
				<blockquote>
					<p>这里只修改文件分类，如上传错了，只能先删除此文件，再行上传：</p>
					<small>选择科目-->选择课件所属目录-->上传课件-->提交数据</small>
				</blockquote>
				<div class="form-group">
					<p style="background:black;color:yellow;padding:10px;">
						当前文件路径为：<span id="currentPath"><?php $breadcrumbs = Catalog::model()->generateBreadcrumbs($model->cid,$model->catalog->course); $category = new CategoryModel(); echo $category->generatePageTitle($breadcrumbs,true,' / ');?></span>
					</p>
				</div>
				<?php $this->renderPartial('_form', array('model'=>$model)); ?>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
$(function(){
	$("#preparation-form").submit(function(){

		var params = $(this).serializeArray();
		// params.r = Math.random(); 

		YKG.app().dom().preAjax($("#currentPath"));

		$.post('/preparation/space/update/<?php echo intval($_GET['id']);?>.html',params,function(data){
			$("#currentPath").html(data);
		});


		return false;			
	});
});
</script>