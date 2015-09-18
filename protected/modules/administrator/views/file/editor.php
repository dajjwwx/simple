<div class="panel panel-default">
	<div class="panel-heading">
		Code Mirror
	</div>
	<div class="panel-body">
		<form class="form" role="form">
			<div class="form-group">
				<div class="input-group"> 
					<label for="path" class="input-group-addon">Current Path:</label>
					<input type="text" id="path" class="form-control" value="<?php echo $_GET['dir'];?>" />
					<div class="btn btn-primary input-group-addon" onclick="saveFile();"><span class="glyphicon glyphicon-floppy-save" title="保存"></span>&nbsp;&nbsp;保存</div>			
				</div>				
			</div>
			<div class="form-group" style="height: auto;">
				<textarea id="myCodeEditor" class="form-control"><?php echo $content;?></textarea>
			</div>			
		</form>
	</div>
</div>


<?php 
$this->widget('ext.CodeMirror.CodeMirrorWidget',array(
		'syntax'=>array('clike','php','js','css','xml'),
		'mode'=>'php',
// 		'value'=>$content,
		'id'=>'myCodeEditor',
));
?>

<script type="text/javascript">
function saveFile(){

	var params = {
		'file':$("#path").val(),
		'content':getEditorValue()
	};
	
	$.post('<?php echo $this->createUrl("file/modify");?>', params, function(data){
		if(data.success == true){
			alert("OK");
		}else{
			alert("Fail");
		}
	},'json');
}
</script>
