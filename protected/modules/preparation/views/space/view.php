<?php
/* @var $this SpaceController */
/* @var $model Preparation */

$this->breadcrumbs=array(
	$this->module->t('preparation','Preparations')=>array('index'),
	Catalog::model()->getCourseName($model->catalog->course)=>array('space/course','id'=>$model->catalog->course),
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

?>

<div class="panel panel-default">
	<div class="panel-heading"><?php echo $model->file->name;?></div>
		<div class="panel-body">
			<div class="view_info">
				<h4><span class="glyphicon glyphicon-file"></span>&nbsp;&nbsp;<?php echo CHtml::encode($model->file->name);?></h4>
				<p>科目：<?php echo Catalog::model()->getCourseName($model->cid);?></p>
				<p>文件属性：<?php echo UtilFileInfo::formatSize($model->file->size);?></p>
				<p>上传时间：<?php echo date('Y/m/d',$model->file->created);?></p>
				<p>文件大小：<?php echo UtilFileInfo::formatSize($model->file->size);?></p>
				<br />
				<p><a href="/preparation/space/download.html?id=<?php echo $model->id;?>"><button type="button" id="downloadButton" class="btn btn-primary btn-lg">下载</button></a></p>

				<hr />

				<div>
				  <!-- Nav tabs -->
				  <ul class="nav nav-tabs" role="tablist">
				    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">评论</a></li>
				    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">在线预览</a></li>
				    <li role="presentation"><a href="relative" aria-controls="relative" role="tab" data-toggle="tab">相关下载</a></li>
				  </ul>

				  <!-- Tab panes -->
				  <div class="tab-content">
				    <div role="tabpanel" class="tab-pane active" id="home">
				    	<div class="view_info">
						
						</div>
				    </div>
				    <div role="tabpanel" class="tab-pane" id="profile">    	
		
						
				    </div>

				    <div role="tabpanel" class="tab-pane" id="relative">
				    	<div id="loadRelative"></div>
				    	<script type="text/template" id="relativeItems">
	    		    		<ul class="list">
								<%if(list.length == 0){%>
									<li>还没上传文件哦</li>
								<%}else{%>
									<%for(var i=0;i<list.length;i++){%>
										<li>
											<div style="border-bottom:1px solid grey;">
											文件名：<a href="javascript:void(0);" id="<%=list[i].id%>">
											<%=list[i].filename%>
											</a><br />						

											</div>
										</li>
									<%}%>
								<%}%>
							</ul>
				    	</script>

				    	<script type="text/javascript">
				    		$(function(){
					    		YKG.app().dom().preAjax($("#loadRelative"));

								$.get('/preparation/space/chapterfiles/id/<?php echo $model->cid;?>.html',{'r':Math.random()},function(data){

									console.log(data);

									var datalist = {
										'list': data
									};

									var html = baidu.template('relativeItems',datalist);
									$("#loadRelative").html(html);


								},'json');
				    		});
				    	</script>
			
				    </div>

				  </div>

				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	
	$(function(){

		$("#downloadButton").click(function(){

			location.href = '/preparation/space/download.html?id=<?php echo $_GET['id'];?>';

		});

	});

</script>