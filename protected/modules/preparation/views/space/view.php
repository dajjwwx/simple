<?php
/* @var $this SpaceController */
/* @var $model Preparation */

$this->breadcrumbs=array(
	$this->module->t('preparation','Preparations')=>array('index'),
	Catalog::model()->getCourseName($model->catalog->course)=>array('space/course','id'=>$model->cid),
	// $model->file->name,
);

$this->menu=array(
	array('label'=>'List Preparation', 'url'=>array('index')),
	array('label'=>'Create Preparation', 'url'=>array('create')),
	array('label'=>'Update Preparation', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Preparation', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Preparation', 'url'=>array('admin')),
);


$menu = array_reverse(Catalog::model()->generateBreadcrumbs($model->cid, $model->catalog->course));

$this->breadcrumbs = array_merge($this->breadcrumbs,$menu);
$this->breadcrumbs = array_merge($this->breadcrumbs,array(UtilString::strSlice($model->file->name,0,50)));

UtilHelper::dump($this->breadcrumbs);
?>

<div class="panel panel-default">
	<div class="panel-heading"><?php echo $model->file->name;?></div>
		<div class="panel-body">
			<div class="view_info">
				<h4><span class="glyphicon glyphicon-file"></span>&nbsp;&nbsp;<?php echo CHtml::encode($model->file->name);?></h4>
				<p>科目：<?php echo Catalog::model()->getCourseName($model->cid);?></p>
				<p>文件属性：<?php echo UtilFileInfo::formatSize($model->file->size);?></p>
				<p>上传时间：<?php echo date('Y/m/d',$model->file->created);?></p>
				<br />
				<p><a href="/preparation/space/download.html?id=<?php echo $model->id;?>"><button type="button" id="downloadButton" class="btn btn-primary btn-lg">下载</button></a></p>

				<hr />

				<div>
				  <!-- Nav tabs -->
				  <ul class="nav nav-tabs" role="tablist">
				    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">评论</a></li>
				    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">在线预览</a></li>

				  </ul>

				  <!-- Tab panes -->
				  <div class="tab-content">
				    <div role="tabpanel" class="tab-pane active" id="home">
				    	<div class="view_info">
						
						</div>
				    </div>
				    <div role="tabpanel" class="tab-pane" id="profile">    	
		
						
				    </div>

				  </div>

				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	
	$(function(){

		$("#downloadButton").click(

			location.href = '/preparation/space/download.html?id=<?php echo $_GET['id'];?>';

		});

	});

</script>