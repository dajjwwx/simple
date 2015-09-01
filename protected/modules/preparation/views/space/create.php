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
<style type="text/css">
.list{
	margin: 0;
	padding: 0;
	list-style-type: none;
}
</style>
<div class="panel panel-default">
	<div class="panel-heading"><?php echo Yii::app()->getModule('preparation')->t('preparations','Upload Preparation');?></div>
	<div class="panel-body">
		<div class=" widget">
			<blockquote>
				<p>这里上传课件,上传文件流程如下：</p>
				<small>选择科目-->选择课件所属目录-->上传课件-->提交数据</small>
			</blockquote>
			<div class="col-md-8">				
				<div class="form-group col-md-12">
					<h5>选择科目</h5>
					<p id="loadCourses">
						<?php $courses = Catalog::model()->getCourses();?>
						<?php for($i=0; $i < sizeof($courses); $i++):?>
							<span class="item">
								<a href="javascript:void(0);" onclick="loadTextBooks($(this));" id="<?php echo $courses[$i]['id'];?>">
									<?php echo $courses[$i]['course'];?>
								</a>
						</span>  
						<?php endfor;?>
						<input type="text" id="Preparation_Course" />
					</p>
				</div>
				<div class="form-group col-md-6">
					<h5>选择课本</h5>
					<p id="loadTextBooks"></p>
					<script type="text/template" id="textBooks">
						<ul class="list">
						<%for(var i=0;i<list.length;i++){%>
							<li><a href="javascript:void(0);" id="<%=list[i].id%>" onclick="loadChapters($(this));">
								<%=list[i].name%>
								</a>
							</li>
						<%}%>
						</ul>
					</script>
					
				</div>
				<div class="form-group col-md-6">
					<h5>选择章节</h5>
					<p id="loadChapters"></p>
					<script type="text/template" id="chapters">
						<ul class="list">
						<%for(var i=0;i<list.length;i++){%>
							<li>
								<%for(var j=0;j<list[i].deep-1;j++){%>―&nbsp;<%}%>
								<a href="javascript:void(0);" id="<%=list[i].id%>" onclick="setCatalogID($(this));">
								<%=list[i].name%>
								</a>
							</li>
						<%}%>
						</ul>
					</script>
					<input type="text" id="Preparation_Chapter" />
					<?php
				// 		$this->widget('ext.treeview.TreeViewWidget',array(
				// // 'link'=>''
				// 		));			
					?>
					</div>
			</div>
			<div class="col-md-4">
				<h5>上传课件</h5>
				<?php $this->renderPartial('_form', array('model'=>$model)); ?>
			</div>


			</div>
		</div>
	</div>
</div>

<script type="text/javascript">

function loadTextBooks(object)
{
	YKG.app().form().singleChoice(object,'Preparation_Course');

	YKG.app().dom().preAjax($("#loadTextBooks"));

	$.get('/preparation/catalog/catalog.html',{'pid':0,'course':object.attr('id')},function(data){
		
		var datalist = {
			'list': data
		};

		var html = baidu.template('textBooks',datalist);
		$("#loadTextBooks").html(html);
	},'json');

}

function loadChapters(object)
{
	YKG.app().form().singleChoice(object,'Preparation_Chapter');

	YKG.app().dom().preAjax($("#loadChapters"));

	$.get('/preparation/catalog/catalog.html',{'pid':object.attr('id'),'course':$("#Preparation_Course").val()},function(data){
		
		var datalist = {
			'list': data
		};

		var html = baidu.template('chapters',datalist);
		$("#loadChapters").html(html);
	},'json');	
}

function setCatalogID(object)
{
	YKG.app().form().singleChoice(object,'Preparation_cid');
}


$(function(){



	// var data = {
	// 	name:"Hello world",
	// 	list:['test1','test2','test3']
	// };

	// var html = baidu.template('textBooks',data);

	// $("#loadTextBooks").html(html);
});
</script>
