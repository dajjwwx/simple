<?php
/* @var $this ProfileController */
/* @var $model Profile */
/* @var $form CActiveForm */
?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'profile-form-head',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'action'=>$this->createUrl('/profile/avatar', array('id'=>Yii::app()->user->id,'#'=>'address')),
// 	'action'=>$this->createUrl('/test/image/thumbnail', array('id'=>Yii::app()->user->id,'#'=>'address')),
	'enableAjaxValidation'=>true,
	'htmlOptions'=>array(
		'class'=>'form',
		'role'=>'form'
	)
)); 
$this->widget('ext.Jcrop.JcropWidget',array(
		'pre_width'=>150,
		'tar_width'=>550
));
?>	
<?php 	

	$cookie = Yii::app()->getRequest()->getCookies();
	
	$filename = '/public/image/head_crop.png';
	
	$id = null;
	
//	unset($cookie['upload']);
	
//	UtilHelper::dump($_COOKIE);
	
	if (isset($cookie['upload']))
	{
		$id = $cookie['upload']->value;
		
//		$newModel = File::model()->findByPk($id);
		$newModel = File::model()->find(array(
			'condition'=>'uid = :uid AND id = :id',
			'params'=>array(
				':uid'=>Yii::app()->user->id,
				':id'=>$id
			)
		));
// 		$imgPath = File::model()->generateFileName($newModel, 'avatar',false);	
		$imgPath = Profile::model()->getUserAvatar(Yii::app()->user->id);
		
		if (file_exists('.'.$imgPath))
		{
			$filename = $imgPath;
			$id = $newModel->id;
		}	

//		$id = $cookie['upload']->value();
		
	}
?>
<?php 

Yii::app()->clientScript->registerScript('avatar-form', "

/**加载头像文件**/
function loadAvatars()
{
	$.get('{$this->createUrl("/profile/avatars",array('id'=>Yii::app()->user->id))}',function(data){
		var html = '<div class=\'row\'><div class=\'panel\'><div class=\'panel-body\'>';
		for(var i in data){
			html += '<div class=\'col-xs-6 col-md-3\'><a href=\'#\' id=\''+data[i].id+'\' class=\'thumbnail\' onclick=\'reloadAvatar($(this))\'><img src=\''+data[i].src+'\' class=\'img-thumbnail\' /><\/a><\/div>';
		}
		html += '<\/div><\/div><\/div>';
		$('#loadAvatars').html(html);
	
	},'json');
}

$('.img-thumbnail').click(function(e){
// 	alert($(this).attr('src'));
	e.preventDefault();
	return false;
});

loadAvatars();

$('#target').click(function(){
	$('#tabs-avatar a:eq(1)').tab('show');
});

");
?>

<script type="text/javascript">

	function getImageInfo(src,callback)
	{
		var w,h;
		var img = new Image();
		img.src = src;
		
		if(window.ActiveXObject) {
		   img.onreadystatechange = function() {
		      if(img.readyState == "loaded" || img.readyState == "complete") {
		        img.onreadystatechange = null;
		        w = img.width;
		        h = img.height;
		        callback(src,w,h);
		     }
		  };
		} else {
		  img.onload = function() {
		    img.onload  = null;
		    w = img.width;
		    h = img.height;
		    callback(src,w,h);
		   };
		}
		return [w,h];	   
	}

	function setSize(src,w,h)
	{
		console.log(w+','+h);
		$('#target,.jcrop-holder img,#preview').attr('src',src).css({'width':565,'height':h/(w/565)});
// 		$(".preview-container").css({'width':180,'height':h/(w/180)});

		JcropAction();
	}
	
	function reloadAvatar(object)
	{

		var src = object.find('img').attr('src').split('_');
		var ext = src[2].split('.');
		console.log(src[2].split('_'));
		
		var href= src[0]+'.'+ext[1]+'?rn='+Math.random();

		$('#modelID').val(object.attr('id'));

		getImageInfo(href,setSize);
					
	}

	//检查是否选取了截图
	function checkCoords()
	{	
		if (parseInt($('#w').val())) 
		{
			var params = {
					'rn':Math.random(),
					'modelID':parseInt($('#modelID').val()),
					'x':parseInt($('#x').val()),
					'y':parseInt($('#y').val()),
					'w':parseInt($('#w').val()),
					'h':parseInt($('#h').val())
			};
	
			$.post('<?php echo $this->createUrl('/profile/avatar');?>', params ,function(data){			

				console.log(data);
				var handle = setTimeout(function(){
// 					src = $('#preview').attr('src');
					
// 					src = data.split('.');
					
					src1 = data+'?rn='+Math.random();
					src2 = data+'?rn='+Math.random();
					src3 = data+'?rn='+Math.random();

					$('#profile_avatar').attr('src',src1);
					$('#preview2').attr('src',src1);
					$('#preview3').attr('src',src2);
					$('#preview4').attr('src',src3);					
								
				},1000);
					
				alert('头像已更改');	

			});		
			
			return ;
		}
		
		alert('请选择一个剪切区域，然后点击“更换头像”按钮.');
		return false;
	};
	


</script>
	<div class="form-group">	
		<div class="col-sm-9">	
			<?php echo $form->errorSummary($model); ?>			
			<input type="hidden" id="x" name="x" />
			<input type="hidden" id="y" name="y" />
			<input type="hidden" id="w" name="w" />
			<input type="hidden" id="h" name="h" />
			<input type="hidden" id="modelID" name="modelID" value="<?php echo $id;?>" />
		
			<div class="panel panel-default">
				<div class="center roundSection" style="border:2px solid #efefef;padding:5px;;">
						<img src="<?php echo $filename;?>" id="target" alt="[Jcrop Example]" />
				</div>
			</div>
				
				<ul class="nav nav-tabs" id ='tabs-avatar' role="tablist">
					<li class="active" onclick=""><a href="#loadUpload" role="tab" data-toggle="tab">上传头像</a></li>
					<li><a href="#loadAvatars" role="tab" data-toggle="tab">已上传头像</a></li>
				</ul>
				<div class="tab-content">
					<div class="tab-pane active" id="loadUpload">
						<?php					
						$this->widget('ext.jqueryupload.JqueryUploadWidget',array(
							'url'=>Yii::app()->createUrl('/profile/uploadavatar',array('id'=>$_GET['id'])),
							'method'=>'POST',
							'id'=>'mulitplefileuploader',
							'allowedTypes'=>'jpg,png,gif,doc,pdf,zip',
							'fileName'=>'Filedata',
							'multiple'=>false,
							'onSuccess'=>'js:function(files,data,xhr)
							{
	
								loadAvatars();
	
								$("#status").html("<font color=\'green\'>Upload is success</font>");
								console.log(data);
								console.log(files);
								
							}',
							'onError'=>'js:function(files,status,errMsg){
							
								console.log(errMsg);
	
								$("#status").html("<font color=\"red\">Upload is Failed</font>");
							}'
						
						));
						?>					
						<div id="mulitplefileuploader">Upload</div>					  
						<div id="status"></div>  
					</div>
					<div class="tab-pane"  id="loadAvatars">
						Exists
					</div>
				</div>		
			</div>		
		</div>
		<div class="col-sm-3">
		  <div id="preview-pane">
		    <div class="preview-container" style="width:150px;height:150px;overflow:hidden;border:1px dashed #ee0000;">
		      <img src="<?php echo $filename;?>" style="width:100%;" id="preview" class="jcrop-preview" alt="Preview" />
		    </div>
		  </div>		 
		  	<br /> 
			<input type="button" value="更换头像" class="btn btn-default" onclick="checkCoords();"/>		
			<hr class="space" />
			当前头像
			<br />
			150*150：
			<div style="width:150px;height:150px;overflow:hidden;border:1px dashed #efefef;" class="roundSection">
				<?php //echo Profile::model()->getUserAvatar(Yii::app()->user->id, array('id'=>'preview2'), 150,'Preview');?>		
				<?php echo Profile::model()->getUserAvatar(Yii::app()->user->id, array('class'=>'img-rounded','id'=>'preview2'),150, 'Preview');?>					
			</div>	
			60*60:
			<div style="width:60px;height:60px;overflow:hidden;border:1px dashed #efefef;" class="roundSection">
				<?php echo Profile::model()->getUserAvatar(Yii::app()->user->id,array('class'=>'img-rounded','id'=>'preview3'), 60, 'Preview');?>							
			</div>
			30*30:
			<div style="width:30px;height:30px;overflow:hidden;border:1px dashed #efefef;" class="roundSection">
				<?php echo Profile::model()->getUserAvatar(Yii::app()->user->id,array('class'=>'img-rounded','id'=>'preview4'), 30, 'Preview');?>							
			</div>
		</div>

<?php $this->endWidget(); ?>
<!-- form -->