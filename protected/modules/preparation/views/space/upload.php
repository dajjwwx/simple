				<?php
					$this->widget('ext.jqueryupload.JqueryUploadWidget',array(
						'url'=>Yii::app()->createUrl('/preparation/space/upload'),
						'method'=>'POST',
						'id'=>'multiplyfileuploader',
						'allowedTypes'=>'pdf,doc,docx,ppt,pptx,wps',//只允许上传PDF文件
						'fileName'=>'Filedata',
						// 'returnType'=>"json",
						'maxFileSize'=>5*1024*1024,
						//'showDownload'=>true,
						//'statusBarWidth'=>600,
						//'dragdropWidth'=>600,
						'multiple'=>false,
						'extErrorStr'=>'允许上传的文件格式为：',
						'sizeErrorStr'=>'您的文件太大了，最大只能上传',
						'dynamicFormData'=>'js:function(){
			                return {"pid":$("#Preparation_cid").val()};
			            }',
						'showDelete'=>true,
						'deleteCallback'=>'js:function (data, pd) {
							for (var i = 0; i < data.length; i++) {
								$.post("delete.php", {op: "delete",name: data[i]},function (resp,textStatus, jqXHR) {
										//Show Message	
										alert("File Deleted");
									});
							}
							pd.statusbar.hide(); //You choice.

						}',
						'onSelect'=>'js:function(files){

							return checkUploadData();


						}',
						'onLoad'=>'js:function(obj){
							console.log($("#gaokao_form").serializeArray());
							
							console.log(obj);
							
							alert($("#Gaokao_course").val());
							
							return false;
						}',
						'onSuccess'=>'js:function(files,data,xhr)
						{	
							eval("data="+data);

							$("#status").html("<font color=\'green\'>Upload is success</font>").fadeOut(1000);
							
							console.log(data);	
							console.log(files);		
							$("#Preparation_fid").val(data.id);
							
						}',
						'onError'=>'js:function(files,status,errMsg){		
							console.log(errMsg);	
							$("#status").html("<font color=\"red\">Upload is Failed</font>");
						}'	
					));
				?>
					<div id="multiplyfileuploader"><?php echo $this->module->t('gaokao','Add Paper');?></div>  
					<div id="status"></div> 