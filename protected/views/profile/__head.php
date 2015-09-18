<!-- 此文件用于显示用户个人爱好相关资料 -->

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'profile-form',
	'enableAjaxValidation'=>true,
	'htmlOptions'=>array(
		'class'=>'form-horizontal',
		'role'=>'form'		
	)
)); ?>

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
	<?php echo $form->errorSummary($model); ?>
	<div class="col-sm-9">
		<div class="group-form">
			<input type="hidden" id="x" name="x" />
			<input type="hidden" id="y" name="y" />
			<input type="hidden" id="w" name="w" />
			<input type="hidden" id="h" name="h" />
			<input type="hidden" id="modelID" name="modelID" value="<?php echo $id;?>" />
		
			<div class="panel panel-default">
				<div class="panel-heading">Heading</div>
					<div class="center roundSection" style="border:2px solid #efefef;padding:5px;;">
						<img src="<?php echo $filename;?>" style="width:100%;" id="target" alt="Flowers" />
					</div>
			</div>
			
			<ul class="nav nav-tabs" role="tablist">
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
		<div class="row clear buttons">
			<?php  
			$url = $model->isNewRecord ? 'create':'updateprofile';
// 			echo CHtml::ajaxSubmitButton($model->isNewRecord ? 'Create' : '下一步',CHtml::normalizeUrl(array($url,'render'=>true,'id'=>$model->id)),array('success'=>'js:function(html){addMessage(html);}'),array('class'=>'button','style'=>'width:100px;height:30px;'));
			?>
		</div>		
		
		<img src="http://jcrop-cdn.tapmodo.com/v0.9.10/demos/demo_files/sago.jpg" id="cropbox" />
		<div style="margin: 20px 0;">
				<span class="requiresjcrop">
					<button id="setSelect">setSelect</button>
					<button id="animateTo">animateTo</button>
					<button id="release">Release</button>
					<button id="disable">Disable</button>
				</span>

				<button id="enable" style="display:none;">Re-Enable</button>
				<button id="unhook">Destroy!</button>
				<button id="rehook" style="display:none;">Attach Jcrop</button>

			</div>
	</div>	
		<div class="col-sm-3">
			头像预览
			<br />
			<div style="width:150px;height:150px;overflow:hidden;border:1px dashed #ee0000;">
				<img src="<?php echo $filename;?>" id="preview" alt="Preview" style="width:150px;" />
			</div>	
			<br />
			<input type="button" value="更换头像" class="button" style="height:30px;" onclick="checkCoords();"/>		
			<hr class="space" />
			当前头像
			<br />
			150*150：
			<div style="width:150px;height:150px;overflow:hidden;border:1px dashed #efefef;" class="roundSection">
				<?php echo Profile::model()->getUserAvatar(Yii::app()->user->id, array('id'=>'preview2'), 150,'Preview');?>		
				<?php //echo Profile::model()->getUserAvatar(Yii::app()->user->id, array('class'=>'img-rounded'),150, 'Preview');?>					
			</div>	
			60*60:
			<div style="width:60px;height:60px;overflow:hidden;border:1px dashed #efefef;" class="roundSection">
				<?php echo Profile::model()->getUserAvatar(Yii::app()->user->id,array('id'=>'preview3'),60,'Preview');?>							
			</div>
			30*30:
			<div style="width:30px;height:30px;overflow:hidden;border:1px dashed #efefef;" class="roundSection">
				<?php echo Profile::model()->getUserAvatar(Yii::app()->user->id,array('id'=>'preview4'),60,'Preview');?>								
			</div>	
		</div>

<?php $this->endWidget(); ?>


<?php 	
	
	$this->widget('ext.Jcrop.JcropWidget',array(
        'pre_width'=>150,
        'tar_width'=>500
    ));
	
	$regionUrl = $this->createUrl('/remote/region');
	
	$avatarUrl = $this->createUrl('/archiver/avatar');
	
	$loadAvartarsUrl = $this->createUrl('/file/avatars',array('uid'=>Yii::app()->user->id));
	
	$actionid = $this->action->id;

	Yii::app()->clientScript->registerScript('avatar-form', "
		
function reloadAvatar(object)
{
	var src = object.find('img').attr('src').split('_');
	var ext = src[2].split('.');
	console.log(src[2].split('_'));
	
	var href= src[0]+'.'+ext[1]+'?rn='+Math.random();

	$('#target').attr('src',href);
	
// 	rehook();		
	
}

/**加载头像文件**/	
function loadAvatars()
{
	$.get('{$this->createUrl("/profile/avatars",array('id'=>Yii::app()->user->id))}',function(data){		
		var html = '<div class=\'row\'><div class=\'panel\'><div class=\'panel-body\'>';			
		for(var i in data){
			html += '<div class=\'col-xs-6 col-md-3\'><a href=\'#\' class=\'thumbnail\' onclick=\'test();return false;\'><img src=\''+data[i].src+'\' class=\'img-thumbnail\' /><\/a><\/div>';
		}			
		html += '<\/div><\/div><\/div>';
		$('#loadAvatars').html(html);
		
	},'json');
}

 loadAvatars();
	
	/*********************************************当前测试代码********************************/

	
	function jcrop(){

    }
    	
	",CClientScript::POS_READY);
	
	Yii::app()->clientScript->registerScript('avatar-form-jcrop', "
					
						

",CClientScript::POS_READY);
?>

<script language="Javascript">

$(window).load(function(){

	var jcrop_api;
	var i, ac;

	initJcrop();
	
	function initJcrop()//{{{
	{

		jcrop_api = $.Jcrop('#cropbox');

		$('#can_click,#can_move,#can_size')
			.attr('checked','checked');

		$('#ar_lock,#size_lock,#bg_swap').attr('checked',false);

	};
	//}}}

	// A handler to kill the action
	// Probably not necessary, but I like it
	function nothing(e)
	{
		e.stopPropagation();
		e.preventDefault();
		return false;
	};

	// Use the API to find cropping dimensions
	// Then generate a random selection
	// This function is used by setSelect and animateTo buttons
	// Mainly for demonstration purposes
	function getRandom() {
		var dim = jcrop_api.getBounds();
		return [
			Math.round(Math.random() * dim[0]),
			Math.round(Math.random() * dim[1]),
			Math.round(Math.random() * dim[0]),
			Math.round(Math.random() * dim[1])
		];
	};

	// Attach interface buttons
	// This may appear to be a lot of code but it's simple stuff

	$('#setSelect').click(function(e) {
		// Sets a random selection
		jcrop_api.setSelect(getRandom());
	});

	$('#animateTo').click(function(e) {
		// Animates to a random selection
		jcrop_api.animateTo(getRandom());
	});

	$('#release').click(function(e) {
		// Release method clears the selection
		jcrop_api.release();
	});

	$('#disable').click(function(e) {
		jcrop_api.disable();

		$('#enable').show();
		$('.requiresjcrop').hide();
	});

	$('#enable').click(function(e) {
		jcrop_api.enable();

		$('#enable').hide();
		$('.requiresjcrop').show();
	});

	$('#rehook').click(function(e) {
		initJcrop();
		$('#rehook,#enable').hide();
		$('#unhook,.requiresjcrop').show();
		return nothing(e);
	});

	$('#unhook').click(function(e) {
		jcrop_api.destroy();

		$('#unhook,#enable,.requiresjcrop').hide();
		$('#rehook').show();
		return nothing(e);
	});

	// The checkboxes simply set options based on it's checked value
	// Options are changed by passing a new options object

	// Also, to prevent strange behavior, they are initially checked
	// This matches the default initial state of Jcrop

	$('#can_click').change(function(e) {
		jcrop_api.setOptions({ allowSelect: !!this.checked });
		jcrop_api.focus();
	});

	$('#can_move').change(function(e) {
		jcrop_api.setOptions({ allowMove: !!this.checked });
		jcrop_api.focus();
	});

	$('#can_size').change(function(e) {
		jcrop_api.setOptions({ allowResize: !!this.checked });
		jcrop_api.focus();
	});

	$('#ar_lock').change(function(e) {
		jcrop_api.setOptions(this.checked? { aspectRatio: 4/3 }: { aspectRatio: 0 });
		jcrop_api.focus();
	});
	$('#size_lock').change(function(e) {
		jcrop_api.setOptions(this.checked? {
			minSize: [ 80, 80 ],
			maxSize: [ 350, 350 ]
		}: {
			minSize: [ 0, 0 ],
			maxSize: [ 0, 0 ]
		});
		jcrop_api.focus();
	});
	$('#bg_swap').change(function(e) {
		jcrop_api.setOptions( this.checked? {
			outerImage: 'http://jcrop-cdn.tapmodo.com/v0.9.10/demos/demo_files/sagomod.png',
			bgOpacity: 1
		}: {
			outerImage: 'http://jcrop-cdn.tapmodo.com/v0.9.10/demos/demo_files/sago.jpg',
			bgOpacity: .6
		});
		jcrop_api.release();
	});

});

</script>


<script type="text/javascript">
function isNumber(s){
	var regu = '^[0-9]+$';
	var re = new RegExp(regu);
	if (s.search(re) != -1) {
		return true;
	} else {
		return false;
	}
} 

function setCookie(cookieName,value)	
{
	var expires = new Date();		
	expires.setTime(expires.getTime() + 3 * 30 * 24 * 60 * 60 * 1000);
	document.cookie = cookieName + '=' + value + ';expires=' + expires.toGMTString();		
//	alert(document.cookie);
}	

function getCookie(cookieName) {
	var cookieString = document.cookie;
	var start = cookieString.indexOf(cookieName + '=');
	// 加上等号的原因是避免在某些 Cookie 的值里有
	// 与 cookieName 一样的字符串。
	if (start == -1) // 找不到
		return null;
	start += cookieName.length + 1;
	var end = cookieString.indexOf(';', start);
	if (end == -1) return unescape(cookieString.substring(start));
	return unescape(cookieString.substring(start, end));
}



//  // Create variables (in this scope) to hold the API and image size
//  var jcrop_api, boundx, boundy;
//  var i, ac;		
 
// initJcrop();
// rehook();
							
// function initJcrop()
// {     
// //	jcrop_api = $.Jcrop('#target');
								
// //	var bounds = jcrop_api.getBounds();
// //    boundx = bounds[0];
// //    boundy = bounds[1];
								
// $('#target').Jcrop({
// //    onChange: updatePreview,
// //    onSelect: updatePreview,
//    aspectRatio: 1
//  },function(){
//    // Use the API to get the real image size
//    var bounds = this.getBounds();
//    boundx = bounds[0];
//    boundy = bounds[1];
//    // Store the API in the jcrop_api variable
//    jcrop_api = this;
//  });	
 						
// };	
						
// function nothing(e)
// {
// 	e.stopPropagation();
// 	e.preventDefault();
// 	return false;
// };

// function getRandom() {
// 	var dim = jcrop_api.getBounds();
// 	return [
// 		Math.round(Math.random() * dim[0]),
// 		Math.round(Math.random() * dim[1]),
// 		Math.round(Math.random() * dim[0]),
// 		Math.round(Math.random() * dim[1])
// 	];
// };

// function rehook()
// {
// 	initJcrop();
// 	return nothing(e);								
// }

// function test(){alert('kkkkk');}


							
//  function updatePreview(c)
//  {
//    if (parseInt(c.w) > 0)
//    {
//      var rx = 100 / c.w;
//      var ry = 100 / c.h;

//      $('#preview1').css({
//        width: Math.round(rx * boundx) + 'px',
//        height: Math.round(ry * boundy) + 'px',
//        marginLeft: '-' + Math.round(rx * c.x) + 'px',
//        marginTop: '-' + Math.round(ry * c.y) + 'px'
//      });
//    }
//  };






// $(function(){
// 	/**********************************************以下为不成熟代码***********************************************************************/
	
// 	//检查是否选取了截图
// function checkCoords()
// {	
// 	if (parseInt($('#w').val())) 
// 	{

// 		$.post('{$this->createUrl('/archiver/avatar')}',{'rn':Math.random(),'modelID':parseInt($('#modelID').val()),'x':parseInt($('#x').val()),'y':parseInt($('#y').val()),'w':parseInt($('#w').val()),'h':parseInt($('#h').val())},function(data){
		
// 			$.get('{$this->createUrl('/archiver/generateavatar')}',{},function(msg){
				
// 			});	

// 			var handle = setTimeout(function(){
// 				src = $('#preview').attr('src');
				
// 				src = src.split('.');
				
// 				src1 = src[0]+'_150.'+src[1]+'?rn='+Math.random();
// 				src2 = src[0]+'_150.'+src[1]+'?rn='+Math.random();
// 				src3 = src[0]+'_150.'+src[1]+'?rn='+Math.random();
				
// 				$('#preview2').attr('src',src1);
// 				$('#preview3').attr('src',src2);
// 				$('#preview4').attr('src',src3);					
							
// 			},1000);
				
// 			Message('头像已更改');	

// 		});		
		
// 		return ;
// 	}
	
// 	Message('请选择一个剪切区域，然后点击“更换头像”按钮.');
// 	return false;
// };

// function Message(data)
// {
//     $('#StatusBar').html(data).show().fadeOut(2000);
// }

// function addMessage(data)
// {
// 	Message(data);
    
//     location.href='#archiver_eauthfinish';
// }

// function loadUpload()
// {



// }
// //loadUpload();

// function updateImage(response)
// {
//    //将返回的JSON字符串转化可为可执行的javascript语句
//    eval('res='+response);
	
// 	id = res.id;
	
// 	$('#modelID').val(id);
	
// //	alert(id);
	
// 	if(isNumber(id))
// 	{		
// 		setCookie('upload',id);	
// 		reload();
// 	}
// 	else
// 	{
// 		Message(response);
// 	}

// }	

// function reload()
// {
// //	$('#blankArea').css({'background':'yellow','opacity':0.2}).load(url).css({'background':'transparent','opacity':1});

// 	$('#blankArea').load('{$this->createUrl('/archiver/eauththird',array('rn'=>time()))}').hide().fadeIn(1500,function(){
// //		alert('ok');	
// 	});
	
	
// }

// function changeAvatar(id)
// {

// 	setCookie('upload',id);

// 	$.get('{$this->createUrl('/archiver/setavatar')}',{'id':id,'rn':Math.random()},function(){

// 	});
// 	reload();
// 	return false;
// }
// //jQuery('#loadAvatars').load('{$loadAvartarsUrl}');

// //$.get('{$loadAvartarsUrl}',{},function(data){
// //	$('#loadAvatars').html(data);
// //});
// loadAvatars();

// function reload()
// {
// //	$('#blankArea').css({'background':'yellow','opacity':0.2}).load(url).css({'background':'transparent','opacity':1});

// 	$('#blankArea').load('{$this->createUrl('/archiver/eauththird',array('rn'=>time()))}').hide().fadeIn(1500,function(){
// //		alert('ok');	
// 	});
	
	
// }

// $('#authprocess ul>li').each(function(i){

// //	alert($(this).attr('id'));
// //	alert('{$actionid}');
// 	if($(this).attr('id') == '{$actionid}')
// 	{
// //		$(this).slibings().removeClass('active');
// 		$(this).addClass('active');
// 	}
// });
// });
</script>