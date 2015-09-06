<?php
/* @var $this SpaceController */
/* @var $model Preparation */
/* @var $form CActiveForm */
?>
<style type="text/css">
.list{
	margin: 0;
	padding: 0;
	list-style-type: none;
}
</style>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'preparation-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>


	<?php echo $form->errorSummary($model); ?>

	<div class="form-group">
		<h5>选择科目</h5>
		<p id="loadCourses" style="border:1px dashed grey;padding:5px;">
			<?php $courses = Catalog::model()->getCourses();?>
			<?php for($i=0; $i < sizeof($courses); $i++):?>
				<span class="item">
					<a href="javascript:void(0);" onclick="loadTextBooks($(this));" id="<?php echo $courses[$i]['id'];?>">
						<?php echo $courses[$i]['course'];?>
					</a>
				</span>  
			<?php endfor;?>
			<input type="text" id="Preparation_Course" class="hide" />
		</p>
	</div>
	<div class="row">	
		<div class="form-group col-md-4">
			<h5>选择课本</h5>
			<div id="loadTextBooks"  style="border:1px dashed grey;padding:5px;">
				<blockquote>
					<p>这里加载对应科目的课本</p>
				</blockquote>
			</div>
			<script type="text/template" id="textBooks">
				<ul class="list">
				<%for(var i=0;i<list.length;i++){%>
					<li>◇&nbsp;<a href="javascript:void(0);" id="<%=list[i].id%>" onclick="loadChapters($(this));">
						<%=list[i].name%>
						</a>
					</li>
				<%}%>
				</ul>
			</script>		
		</div>
		<div class="form-group col-md-4">
			<h5>选择章节</h5>
			<div id="loadChapters" style="border:1px dashed grey;padding:5px;">
				<blockquote>
					<p>这里加载课本的章节目录</p>
				</blockquote>
			</div>
			<script type="text/template" id="chapters">
				<ul class="list">
				<%for(var i=0;i<list.length;i++){%>
					<li>
						<%for(var j=0;j<list[i].deep-1;j++){%>◇&nbsp;<%}%>
						<a href="javascript:void(0);" id="<%=list[i].id%>" onclick="setCatalogID($(this));">
						<%=list[i].name%>
						</a>
					</li>
				<%}%>
				</ul>
			</script>
			<input type="text" id="Preparation_Chapter" class="hide" />
			<?php
		// 		$this->widget('ext.treeview.TreeViewWidget',array(
		// // 'link'=>''
		// 		));
			?>
		</div>
		<div class="col-md-4">
			<h5>上传课件</h5>
			<div class="form-group">
				<?php if($this->action->id == 'update'):?>
					<div style="border:1px dashed grey;padding:5px;">
					修改信息不能上提供上传服务
					</div>
				<?php else:?>
					<?php $this->renderPartial('upload');?>
				<?php endif;?>
			</div>

			<div class="form-group">
				<div id="existsFilesBox"></div>
				<script type="text/template" id="existsFiles">
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
			</div>

			<div class="form-group">
				<?php //echo $form->labelEx($model,'cid'); ?>
				<?php echo $form->hiddenField($model,'cid'); ?>
				<?php echo $form->error($model,'cid'); ?>
			</div>
			<div class="form-group">
				<?php //echo $form->labelEx($model,'fid'); ?>
				<?php echo $form->hiddenField($model,'fid'); ?>
				<?php echo $form->error($model,'fid'); ?>
			</div>

			<div class="form-group buttons">
				<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'btn btn-primary pull')); ?>
			</div>
			
		</div>
	</div>
<?php $this->endWidget(); ?>

</div><!-- form -->

<script type="text/javascript">
		
	function checkUploadData(){
		var cid = $("#Preparation_cid").val();
		var course = $("#Preparation_Course").val();
		var chapter = $("#Preparation_Chapter").val();

		var body = "";

		if(cid != "" && course != "" && chapter != ""){
			return true;
		}

		if(cid == ""){
			body = "请选择章节";
		}

		if(course == ""){
			body = "请选择科目";
		}

		if(chapter == ""){
			body = "请选择课本"
		}


		YKG.app("bootstrap").showModal({
			"id":"defaultModal",
			"title":"操作提示",
			"body":body,
			"showEvent":function(){
				// alert("HEllo wrld");
			}
		}).show().showEvent();
		return false;
	}

	function checkPreparationData()
	{
		var uploadData = checkUploadData();
		if(uploadData){
			var fid = $("#Preparation_fid").val();

			if(fid != ""){
				return true;
			}else{

				YKG.app("bootstrap").showModal({
					"id":"defaultModal",
					"title":"操作提示",
					"body":"请先上传课件",
					"showEvent":function(){
						// alert("HEllo wrld");
					}
				}).show().showEvent();

			}

		}
	}

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

	function loadExistsFiles(id)
	{
		YKG.app().dom().preAjax($("#existsFilesBox"));

		$(".ajax-file-upload-statusbar").empty();

		$.get('/preparation/space/chapterfiles/id/'+ id +'.html',{'r':Math.random()},function(data){

			var datalist = {
				'list': data
			};
			var html = baidu.template('existsFiles',datalist);
			$("#existsFilesBox").html(html);


		},'json');
	}

	function setCatalogID(object)
	{
		YKG.app().form().singleChoice(object,'Preparation_cid');

		loadExistsFiles(object.attr('id'));
	}
	
</script>
















	

