<div class="panel panel-default">
	<div class="panel-heading">
		<h4><span class="glyphicon glyphicon-file"></span>本地文件</h4> 
	</div>
	<div class="panel-body">
		<form class="form" role="form">
			<div class="form-group col-md-6">
				<div class="input-group">
					<div class="input-group-addon">当前位置：</div>
					<input id="path" class="form-control" type="text" onclick=""  value="<?php echo  isset($_GET['dir'])?$_GET['dir']:$_SERVER["DOCUMENT_ROOT"];?>"  placeholder="当前位置 "   data-placement="bottom" data-container="body" data-toggle="popover" title="新建文件夹提示" data-content="在当前位置文本框后输入要创建的文件夹名称。" />
				
					<?php 
						if (strpos($_GET['dir'],$_SERVER['DOCUMENT_ROOT'])) {
							$link = UtilFile::previewDir($_GET['dir']);
						}else{
							$link=$_SERVER['DOCUMENT_ROOT'];
						}
					?>
					
					<div class="input-group-addon btn"><?php echo CHtml::link('返回上一目录','?dir='.UtilFile::previewDir($_GET['dir']));?></div>				
				</div>
			</div>
			<div class="form-group col-md-4">
				<div class="input-group pull-right">
					<div class="btn-group">
						<button type="button" id="createfolder" class="btn btn-default"  data-placement="bottom" data-container="body" data-toggle="popover" title="新建文件夹提示" data-content="在当前位置文本框后输入要创建的文件夹名称。" ><span class="glyphicon glyphicon-folder-open"></span>&nbsp;&nbsp;新建文件夹</button>
						<button type="button" id="createfile" class="btn btn-default"><span class="glyphicon glyphicon-edit"></span> 新建文件</button>
					</div>
				</div>
			</div>
			<div class="form-group col-md-2">
				<div class="input-group">
					<input class="form-control" type="search" placeholder="搜索 " />
					<div class="input-group-addon "><span class="glyphicon glyphicon-search"></span></div>
				</div>
			</div>
		</form>
	</div>
	<table class="table table-striped">
		<thead>
			<tr>
			<th>文件名</th>
			<th>创建时间</th>
			<th>文件大小</th>
			</tr>
		</thead>
		<tbody>
			<?php 
				foreach ($files as $file):
// 				$filename = $_SERVER["DOCUMENT_ROOT"].'/'.$file['filename'];
			?>
			<tr>
				<td><?php echo UtilFile::showFileIco($file);?></td>
				<td><?php echo date('Y-m-d h:i:s',filectime($file['path']));?></td>
				<td><?php echo $file['filesize'];?></td>
			</tr>
			<?php 		
				endforeach;	
			?>		
		</tbody>
	</table>
</div>

<script type="text/javascript">
function createFolder()
{
	if($("#path").val()=='<?php echo $_GET['dir'];?>' || $("#path").val() == '')
	{
		$('#path').trigger('click');
	}
	else
	{

		var params = {
				'path':$("#path").val()
			};

			$.get('<?php echo $this->createUrl("file/createfolder");?>',params,function(data){
				console.log(data);
			});
		alert("成功了");
	}

	

	
}



$(function(){
	$("[data-toggle='popover']").popover();
});


</script>

