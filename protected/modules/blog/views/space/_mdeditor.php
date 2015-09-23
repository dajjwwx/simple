<?php
/* @var $this SpaceController */
/* @var $model Blog */
/* @var $form CActiveForm */
?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'blog-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array(
		'class'=>'form',
		'role'=>'form'
	)
)); ?>
<script type="text/javascript">
$(function(){
	// mdeditor.previewing();
});
</script>

<?php
    $this->widget('ext.mdeditor.MdeditorWidget',array(
                'width' => "100%",
                'syncScrolling' => "single",
                'height'=> '740px',
                // 'theme' => "dark",
                // 'previewTheme' => "dark",
                // 'editorTheme' => "pastel-on-dark",
                'markdown' => null,
                'codeFold' => true,
                //'syncScrolling' => false,
                'saveHTMLToTextarea' => true,    // 保存 HTML 到 Textarea
                'searchReplace' => true,
                //'watch' => false,                // 关闭实时预览
                'htmlDecode' => "style,script,iframe|on*",            // 开启 HTML 标签解析，为了安全性，默认不开启    
                //'toolbar'  => false,             //关闭工具栏
                //'previewCodeHighlight' => false, // 关闭预览 HTML 的代码块高亮，默认开启
                'emoji' => true,
                'taskList' => true,
                'tocm'            => true,         // Using [TOCM]
                'tex' => true,                   // 开启科学公式TeX语言支持，默认关闭
                'flowChart' => true,             // 开启流程图支持，默认关闭
                'sequenceDiagram' => true,       // 开启时序/序列图支持，默认关闭,
                //'dialogLockScreen' => false,   // 设置弹出层对话框不锁屏，全局通用，默认为true
                //'dialogShowMask' => false,     // 设置弹出层对话框显示透明遮罩层，全局通用，默认为true
                //'dialogDraggable' => false,    // 设置弹出层对话框不可拖动，全局通用，默认为true
                //'dialogMaskOpacity' => 0.4,    // 设置透明遮罩层的透明度，全局通用，默认值为0.1
                //'dialogMaskBgColor' => "#000", // 设置透明遮罩层的背景颜色，全局通用，默认为#fff
                'imageUpload' => true,
                'imageFormats' => ["jpg", "jpeg", "gif", "png", "bmp", "webp"],
                'imageUploadURL' => "./php/upload.php",
                'onload' => function() {
                    // console.log('onload', this);
                    //this.fullscreen();
                    //this.unwatch();
                    //this.watch().fullscreen();

                    //this.setMarkdown("#PHP");
                    //this.width("100%");
                    //this.height(480);
                    //this.resize("100%", 640);
                }
	));

    ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="form-group">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>50,'maxlength'=>50,'class'=>'form-control','placeholder'=>'日志标题')); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>
	
	<div class="form-group">
			<!--style给定宽度可以影响编辑器的最终宽度-->
			<script type="text/plain" id="editor" style="" name="Blog[content]">
				<?php echo $model->content; ?>
			</script>
			<?php //echo $form->error($model,'content'); ?>
			<?php //echo $form->hiddenField($model, 'arc_content');?>
    		<?php echo $form->error($model,'content'); ?>
	</div>
	
	<div class="row">
		<div class=" col-sm-6">
			<div class="form-group">
				<?php echo $form->labelEx($model,'tags'); ?>
				<?php echo $form->textField($model,'tags',array('size'=>60,'maxlength'=>50,'style'=>'width:60%;','class'=>'form-control','placeholder'=>Yii::t('blog','Tags'))); ?>
				<a href="javascript:void(0);" onclick="getTags();" style="margin-left:65%;margin-top:-25px;" class="pull-left">获取标签</a>
				<?php echo $form->error($model,'tags'); ?>
			</div>	
			<a href="javascript:void(0);" onclick="showNext($(this));" class="more-setting">+ 更多设置</a>
			<div style="display:none;">
			<br />
			<div class="form-group">
				<?php echo $form->labelEx($model,'iscomment'); ?>
				<br />
				<div class="btn-group" data-toggle="buttons">
					<?php foreach (Blog::model()->generateCommentStatusDropdownList() as $k=>$v):?>
					  <label class="btn btn-primary  <?php echo $model->iscomment == $k ?'active':'';?>">
					    <input type="radio" value="<?php echo $k;?>" name="Blog[iscomment]" id="Blog_iscomment_<?php echo $k;?>" autocomplete="off" <?php echo $model->iscomment == $k ?'checked':'';?>> <?php echo $v;?>
					  </label>
					<?php endforeach;?>
				</div>
				<?php echo $form->error($model,'iscomment'); ?>
			</div>		
		
			<div class="form-group">
				<?php echo $form->labelEx($model,'isrecommend'); ?>
				<br />
				<div class="btn-group" data-toggle="buttons">
					<?php foreach (Blog::model()->generateRecommendStatusDropdownList() as $k=>$v):?>
					  <label class="btn btn-primary  <?php echo $model->isrecommend == $k ?'active':'';?>">
					    <input type="radio" value="<?php echo $k;?>" name="Blog[recommend]" id="Blog_isrecommend_<?php echo $k;?>" autocomplete="off" <?php echo $model->isrecommend == $k ?'checked':'';?>> <?php echo $v;?>
					  </label>
					<?php endforeach;?>
				</div>
				<?php echo $form->error($model,'isrecommend'); ?>
			</div>
			
			<div class="form-group">
				<?php echo $form->labelEx($model,'status'); ?>
				<br />
				<div class="btn-group" data-toggle="buttons">
					<?php foreach (Blog::model()->generateStatusDropdownList() as $k=>$v):?>
					  <label class="btn btn-primary  <?php echo $model->status == $k ?'active':'';?>">
					    <input type="radio" value="<?php echo $k;?>" name="Blog[status]" id="Blog_status_<?php echo $k;?>" autocomplete="off" <?php echo $model->status == $k ?'checked':'';?>> <?php echo $v;?>
					  </label>
					<?php endforeach;?>
				</div>				
				<?php echo $form->error($model,'status'); ?>
			</div>	
		
			<div class="form-group">
				<?php echo $form->labelEx($model,'ctype'); ?>
				<br />
				<div class="btn-group" data-toggle="buttons">
					<?php foreach (Blog::model()->generateContentTypeDropdownList() as $k=>$v):?>
					  <label class="btn btn-primary  <?php echo $model->ctype == $k ?'active':'';?>">
					    <input type="radio" value="<?php echo $k;?>" name="Blog[ctype]" id="Blog_ctype_<?php echo $k;?>" autocomplete="off" <?php echo $model->ctype == $k ?'checked':'';?>> <?php echo $v;?>
					  </label>
					<?php endforeach;?>
				</div>			
				<?php echo $form->error($model,'ctype'); ?>
			</div>
			
			
			</div>
			<br />
		<button type="submit" class="btn btn-primary"><?php echo $model->isNewRecord ? Yii::t('basic','Publish') : Yii::t('basic','Save');?></button>
	
	
		</div>
		<div class="col-sm-6">
		<div class="row">
			<?php echo $form->labelEx($model,'cids'); ?>
		</div>
		
		<div class="row"  style="overflow-y:auto; padding:5px; min-width:250px;max-height:200px;">
			<div class="widget" >
	              <?php 
// 					echo UtilTree::generateCheckTreeByType(Category::CATEGORY_BLOG, 'checkItem', array('class'=>'categories','id'=>'categoryList'));
			    	//$this->widget('application.components.school.category.articleCategoryList');
// 			    	echo Category::model()->generateCheckTreeByType(Category::CATEGORY_BLOG, array('treeview'=>Category::TREE_VIEW_CHECK,'name'=>'checkItem'),array('class'=>'categories checkCategories','id'=>'categoryList'));
			   	?> 		
			   	<?php 
			   		$this->widget('ext.treeview.TreeViewWidget',array(
							'type'=>Category::CATEGORY_BLOG,
							'treeview' => Category::TREE_VIEW_CHECK,
							'htmlOptions'=>array(
								'id'=>'categoryList',
								'class'=>'categories checkCategories treeview'
							)
					));
			   	?>		
			</div>			
			<input type="hidden" id="Blog_cids" name="Blog[cids]" value="<?php echo $model->cids;?>"/>
			<textarea rows="3" style="display:none;" cols="20" id="Blog_result" name="Blog[result]"></textarea>
  
    	</div>	
    	
    	<div class="row">
        	<span id="categorylabel"></span><a href="javascript:void(0);" onclick="showNext($(this));" class="more-setting">+增加分类</a>
            
	       	<div style="display: none;">	<br />
	               <div style="margin:0px;">
	                   <?php echo CHtml::dropDownList('categories',1, Category::model()->getCategoryDropdownList(Category::CATEGORY_BLOG),array(
	                   			'title'=>'选择分类'
	                   		)); ?>	
	                   <?php echo $form->error($model,'cids'); ?>
	               </div>
		           <div  style="padding-top:10px;">	                  	
	        		  <input type="text" id="categoryName" name="categoryName" title="输入新分类"/>	
	               </div>
	                <br />
	                <button class="minimal" id="add_category" type="button"  title="添加分类">添加分类</button>    		
	    	</div>	 
    	</div>
		</div>	
	</div>
	

<?php $this->endWidget(); ?>
<!-- form -->
<script type="text/javascript">
var temp;
//显示/隐藏文本内容
function showNext(object){

	if(object.attr("alt") != '- 隐藏') {
		object.attr("alt", "- 隐藏");
		object.attr("title", object.text());
		object.text(object.attr("alt"));
	}else{
		object.text(object.attr("title"));	
		object.attr("title",object.attr("alt"));
		object.attr("alt", object.text());			
	}
	
	console.log(object.text());

	object.next().slideToggle("slow");
	
	return false;
}
//改变标签内容
function changeText(object, id){
	var label = object.find("option:selected").text();
//	alert(id.html()+label);
	id.text(label);
}
function checkboxChange()
{
//
	$("input[name=checkItem][type=checkbox]").change(function(){

		var str = "";
		$("input[name=checkItem][type=checkbox]:checked").each(function(){
				str += ","+$(this).val();
		});		
		str = str.substring(1,str.length);
		console.log(str);
		$("#Blog_cids").val(str);

	});	
}

//获取当前编辑文本相关信息，并格式化
function showValues() {
    var fields = $(":input").serializeArray();
    $("#results").empty();
    $.each(fields, function(i, field){
      $("#results").append(field.name+":"+addSlash(field.value) + "|#-#-#-#|");
    });
//    $("#Blog_result").val($("#results").html());
    
  }

  function addSlash(val){
		val = val.replace(/:/g,"\\:");
		val = val.replace(/;/g,"\\;");

//		alert(val);
		return val;
  }

//自动保存
  function AutoSave(){

	  var data = $("#article-form").serializeArray();

	  console.log(data);
	  
		$.post("<?php echo $this->createUrl('/service/autosave'); ?>", data, function(msg){
			$("#autosave").html(msg);
		});		
  }

  window.setInterval("AutoSave()",18000);

  function getTags()
  {
		var content = UE.getEditor('editor').getContent();
	  
		$.post('<?php echo $this->createUrl('/service/gettags'); ?>',{'content':content},function(msg){
			$("#Blog_tags").val(msg);
		});
  }

$(function(){


	$("body").mousemove(function(){
		$("#Article_content").val(UE.getEditor('editor').getContent());
	});

	
	//checkbox onChange事件
	checkboxChange();

	var cids = "<?php echo $model->cids;?>";

	cids = cids.split(",");

	for( value in cids){
		$("input[name=checkItem][type=checkbox]").each(function(i){
			if($(this).val()==cids[value]){
				$(this).attr("checked","checked");
			}
		});
	}
	
	$("#add_category").click(function(){
		
		$.post("<?php echo $this->createUrl('/administrator/category/createajax');?>",{Category:{
			'pid':$("#categories").val(),
			'name':$("#categoryName").val(),
			'type':<?php echo Category::CATEGORY_BLOG;?>,
			'description':'无',
			'weight':<?php echo rand(10, 500);?>
			
		}},function(data){
//			alert(msg);
//			$(".category").append(msg);

			console.log(data);

			if(data.state == 'success'){

				$("#categoryList").html("loading.......");
				
				$.get('<?php echo $this->createUrl('/administrator/category/list');?>',{'id':<?php echo Category::CATEGORY_BLOG;?>},function(msg){
					console.log(msg);
					$("#categoryList").html($(msg).html());
				});			

				$.getJSON("<?php echo $this->createUrl('/administrator/category/dropdownlist');?>",{'type':<?php echo Category::CATEGORY_BLOG;?>},function(msg){
//			 	      alert(msg);
							
				        var pid = document.getElementById("categories");

				            //清除所有已有选项
				            while(pid.childNodes.length>0){
				            	pid.removeChild(pid.childNodes[0]);
				           }
				           $.each(msg,function(k,v){
//								dd += (k+v);
				            					
				            var option = new Option(k,v);
				            	pid.options.add(option);
				            });
//				            alert(dd);

					       	//checkbox onChange事件
					       	checkboxChange();
				    	});		
	

			}else{


				
			}			
			

		},'json');

	});
});
</script>