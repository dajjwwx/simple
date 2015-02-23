<?php
/* @var $this FavorController */
/* @var $model Favor */
/* @var $form CActiveForm */
?>
<!-- 此文件用于显示用户个人爱好相关资料 -->
<style type="text/css">
.tips{
	border:1px solid #efefef;
	background:#e8f8f8;
}
.tips h5{
	padding-left:20px;
}
.tips .tipsContent{
	padding:0px 20px 20px 20px;
	line-height:1em;
}
.tips .tipsContent .tags a,.tips .tipsContent .items a,.row .selectItems a {
	display:inline-block;
	border:1px solid grey;
	color:grey;
	padding:2px;
	margin:2px;
}
.tips .tipsContent .input,.tips .tipsContent .tags,.tips .tipsContent .items{
	width:400px;

}
.tips .tipsContent .input input{
	width:390px;;

}
.tips .tipsContent .items{
	background:white;
	margin-top:1px;
}
.row input{
	color:grey;
}
.row .selectItems{
	width:510px;
}

</style>

<script type="text/javascript">
var prehtml = '<br /><div class=\"tips hide span-15\"><br /><h5></h5><div class=\"tipsContent\"><p>通过单击以下标签进行选择：<a href=\"javascript:void(0);\" onclick=\"getTags($(this).parent().siblings(\".input\").find(\"input\"),$(this).parent().next(\".tags\"),20,20*parseInt($(this).attr(\"title\")));$(this).parent().next(\".tags\").html().indexOf(\"a\")>0?$(this).attr(\"title\",parseInt($(this).attr(\"title\"))+1):$(this).attr(\"title\",1);\" title=\"1\">换一下</a></p><div class=\"tags\"></div><hr class=\"space\" /><br /><div class=\"input\"></div><div class=\"items\"></div></div></div>';

</script>
<?php 	

//     $this->widget('ext.poshytip.Poshytip', array(
//     	"selector"=>".poshy",	
//     	'tooltips'=>array(
// 			'className'=>'tip-yellowsimple',
// 			'showOn'=>'focus',
// 			'alignTo'=>'target',
// 			'alignX'=>'right',
// 			'alignY'=>'center',
// 			'offsetX'=>5	
//     	)	
//     ));

//     $this->widget('ext.chosen.chosenWidget');
    // showTips the extension
// 	$this->widget('ext.jnotify.JNotify', array(
// 		'statusBarId'=>'StatusBar',
// 		'notificationId'=>'Notification',
// 		'notificationHSpace'=>'30px',	
// 		'notificationWidth'=>'280px',
// 		'notificationShowAt'=>'topRight',
// 		//'notificationShowAt'=>'bottomLeft',
// 		//'notificationAppendType'=>'prepend',
// 	)); 
	
// 	$regionUrl = $this->createUrl('/remote/region');
	$tags = $this->createUrl('/profile/tags');
	
	Yii::app()->clientScript->registerScript('favor-form', "
// 	function addMessage(data)
// 	{
// 	    $('#StatusBar').jnotifyAddMessage({
// 	        text: data,
// 	        permanent: false,
// 	        type: 'error',
// 	        showIcon: false
// 	    });
// 	}
	
//	uu.scrollFollow($('#notice'),15);

	//当激活新文本框时还原为待激活状态，并保存相关数据
	function __setData(object)
	{
		//处理已经加载的对象
		var tip = $('#selectedTips');	
		tip.removeAttr('id');		//去除原有文本框ID

		//把选择的项目导出到selectItems
		var items = tip.find('.tipsContent').find('.items').find('a').addClass('btn btn-default btn-xs');
		items.find('span').remove();		
		tip.siblings('.selectItems').append(items);

		//把文本框还原
		var input = tip.find('.input').find('input');
		input.val($('#'+input.attr('id')+'hidetip').val());		
		tip.after(input);
		$('.tips').addClass('hide');		

	}
	
	//第一次激活时为文本框设置激活模板
	function __setTemplate(object)
	{
		var prehtml = '<div class=\"tips\" id=\"selectedTips\"><br /><h5></h5><div class=\"tipsContent\"><p>通过单击以下标签进行选择：<a href=\"javascript:void(0);\" onclick=\"changeTags($(this));\" title=\"1\">换一下</a></p><div class=\"tags\"></div><br /><div class=\"input\"></div><div class=\"items\"></div></div></div>';
		object.parent().prepend(prehtml);
		object.after(object.clone().attr('id',object.attr('id')+'hide').val(object.val()).hide().removeAttr('placeholder'));
		object.after(object.clone().attr('id',object.attr('id')+'hidetip').val(object.val()).hide().removeAttr('placeholder'));	
		
		object.val($('#'+object.attr('id')+'hidetip').val());
		
		//显示提示框
		var parent = object.parent().parent().show();
		
		//设置标题
		var title = object.attr('placeholder');
		parent.find('h5').html(title);
		
		//填充标签
		getTags(object,parent.find('.tags'),20,0);

	}
	
	//当再次激活文本框时还原数据为激活状态
	function __setInputBox(object)
	{	
		var html = '<span class=\"glyphicon glyphicon-remove\"></span>';
		//还原selectItems中的数据到items
		var items = object.siblings('.selectItems').find('a').addClass('btn btn-default btn-xs').append(html).appendTo(object.siblings('.tips').find('.items'));

		object.appendTo(object.parent().find('.input'));	

	}

	function initialize(object)
	{
		//检验文本框所处的位置
		if(object.parent().hasClass('input')){			
			return ;
		}			
		__setData(object);		
	
		//预加载代码
		if(object.next().hasClass('selectItems')){
			__setTemplate(object);
		} else {			
			object.parent().find('.tips').removeClass('hide').attr('id','selectedTips');		
		}	
		__setInputBox(object);	
		
		inputFocus(object.parent().parent());
	}

	function inputFocus(object){
		object.find('.input').find('input').focus();
	}
	
	function getTags(object,target,limit,offset)
	{
		$.get('{$tags}',{'type':object.attr('alt'),'limit':limit,'offset':offset},function(data){
			target.html(data);
		});
	}
	
	function changeTags(object){
		var type = object.parent().siblings('.input').find('input');
		var target = object.parent().siblings('.tags');
		var offset = 20*parseInt(object.attr('title'));
		getTags(type,target,20,offset);
		
		if(object.parent().next('.tags').html().indexOf('a')>0){
			object.attr('title',parseInt(object.attr('title'))+1);
		}else{
			object.attr('title',1);
		}
	}	
	
// 	initialize($('Favor_star'));	


	function showTips(object)
	{
		var text = object.text();
		target = object.parent().siblings('.items');
		
		var html = '<span class=\"glyphicon glyphicon-remove\"></span>';
		
		if(parseInt(target.html().indexOf(text)) > 0)
		{
//			alert(target.html().indexOf(text));
// 			addMessage('已经有了哈～');
			return ;
		}
		
		
//		if(trim(target.text()) != '' && target.html().indexOf(text) > 0){
//			alert('已经有了');
//			return ;
//		}

		if(object.hasClass('select')){
			object.removeClass('select').addClass('selected btn btn-default btn-xs').append(html);
		}		
		
		object.attr('onclick','back($(this));').hide().appendTo(target);
		object.fadeIn();
		
		getItems(target,target.siblings('.input').find('input').attr('id'));
		
		return false;		
	}
	
	/**
	 *注意：此处对于默认的选择项目取消有点问题，不能正确调用，出现语法错误
	 */
	function back(object)
	{
		var tags = object.parent().siblings('.tags');		
		var id = tags.siblings('.input').find('input').attr('id');
// 		console.log(id);
		if(tags.text().indexOf(object.text())>0){
			object.remove();
			return ;
		}		
	
		object.attr('onclick','showTips($(this));return false;').removeAttr('style').removeClass('selected btn btn-default btn-xs').addClass('select').find('span').remove();
		object.appendTo(tags);
		
		getItems(tags.siblings('.items'),id);
	}
	
	function getItems(object,id){
		var result = '';
		object.find('a').each(function(i){
			result += $(this).text()+',';
		});
		
		if(object.text().length > 100){
			alert('不得了了，超标了');
			return ;
		}
		
		$('#'+id+'hide').val(result);
		$('#'+id).val(result);
		$('#tempRecord').val(result);
		console.log(id+'hide.value='+result);
		
		return result;
	}

",CClientScript::POS_HEAD);
?>
<!-- <button type="button" id="test">Hello</button> -->
<script type="text/javascript">
$(function(){

	$("#test").click(function(){

		console.log($('#profile-form-favor').serializeArray());

		$('#profile-form-favor').find('input[type=\"text\"]').each(function(index){
			var pattern = /^Favor_.*/;

			var id = $(this).attr('id');

			if(typeof(id) == 'string'){
				console.log(id);
				var result = pattern.test(id);
				console.log(result);			
				
				if(pattern.test(id)){
					var patternHide = /^Favor_.*hide.*/;
// 					console.log(patternHide.test(id));
					if(patternHide.test(id)){
						var item = id.split('hide')[0];

						console.log(item);

						console.log(item+':'+$(item).val());

						$(item).val($(item+'hide').val());					
						
					}					
				}
	
			}
		});
	});

// 	$('input[type="text"]').val(function(){
// 			return $(this).attr('placeholder');
// 	});
	
//	$('#notice').smartFloat();

	/**
	 *思路描述：
	 *		1.input获取焦点，然后初始化加载tips模板
	 *		2.
	 */
	
	$('#profile-form-favor').find('input[type=\"text\"]').focus(function(){
		//加载模板
		initialize($(this));
		//把文本内容传入临时表单
		$('#tempRecord').val($(this).val());

// 		$($(this).attr('id')+'hide').val($(this).val());
		//关闭文本框的自动完成
		$(this).attr('autocomplete',false);
		//清空默认内容
		$(this).val('');
	}).blur(function(){
		if($(this).val() == ''){
			if($('#tempRecord').val() != ''){
				$(this).val($('#tempRecord').val());
			}else{
				$(this).val($('#'+$(this).attr('id')+'hide').val());
			}			
		}else{			
			//检查填写的标签是否有重复，并把当前填写的标签在下面显示出来
			var val = $(this).val();
			var items = $(this).parent().next('.items');
			var select = items.html();
			val = val.replace(/[\；\;\:\：\|\｜\，]/g,',');		
			splits = val.split(',');
			
			var html = select;
			
			for(var i=0;i<splits.length;i++){
				if(html.indexOf(splits[i]) < 0){
					html += '<a href=\"javascript:void(0);\" id=\"tag-'+Math.round(Math.random()*1000)+'\" class=\"selected btn btn-default btn-xs\" onclick=\"back($(this))\" style=\"display: inline-block;\">'+splits[i]+'<span class=\"glyphicon glyphicon-remove\"></span></a>';
				}
			}
			
			items.html(html);
			
			getItems(items,$(this).attr('id'));
		}
	});
});
</script>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'profile-form-favor',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// See class documentation of CActiveForm for details on this,
	// you need to use the performAjaxValidation()-method described there.
	'action'=>$this->createUrl('/profile/favor', array('id'=>Yii::app()->user->id,'#'=>'favor')),
	'enableAjaxValidation'=>false,
 	'htmlOptions'=>array(
		'class'=>'form-horizontal',
		'role'=>'form'
	)
)); ?>
	<div class="col-sm-9">
	<?php echo $form->errorSummary($model); ?>
	<div class="form-group">
		<?php echo $form->labelEx($model,'food',array('class'=>'col-sm-2 control-label')); ?>
		<div class="col-sm-10">
			<?php echo $form->textField($model,'food',array('size'=>60,'maxlength'=>100,'alt'=>Tag::TAG_FOOD,'placeholder'=>'什么东西让你丫一想到就流哈喇子呢？泡菜，羊肉泡膜还是……','class'=>'form-control','title'=>'喜欢的美食')); ?>
			<div class="selectItems">
				<?php echo Tag::model()->generateTags($model->food);?>				
			</div>
			<?php echo $form->error($model,'food'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'movie',array('class'=>'col-sm-2 control-label')); ?>
		<div class="col-sm-10">
			<?php echo $form->textField($model,'movie',array('class'=>'form-control','size'=>60,'maxlength'=>100,'alt'=>Tag::TAG_MOVIE, 'placeholder'=>'你喜欢哪些电影？哪种类型？武侠，美国大片，还是……','title'=>'喜欢的影视')); ?>
			<div class="selectItems">
				<?php echo Tag::model()->generateTags($model->movie);?>
			</div>
			<?php echo $form->error($model,'movie'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'music',array('class'=>'col-sm-2 control-label')); ?>
		<div class="col-sm-10">
			<?php echo $form->textField($model,'music',array('size'=>60,'maxlength'=>100,'alt'=>Tag::TAG_MUSIC,'placeholder'=>'你丫喜欢什么类型的音乐？R&B，乡村民乐，还是……','class'=>'form-control','title'=>'喜欢的音乐')); ?>
			<div class="selectItems">
				<?php echo Tag::model()->generateTags($model->music);?>
			</div>
			<?php echo $form->error($model,'music'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'tourism',array('class'=>'col-sm-2 control-label')); ?>
		<div class="col-sm-10">
			<?php echo $form->textField($model,'tourism',array('class'=>'form-control','size'=>60,'maxlength'=>100,'alt'=>Tag::TAG_TOURISM,'placeholder'=>'每一个人都有一个向往的圣地，你的圣地在何方？','title'=>'喜欢的旅游圣地')); ?>
			<div class="selectItems">
				<?php echo Tag::model()->generateTags($model->tourism);?>
			</div>
			<?php echo $form->error($model,'tourism'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'books',array('class'=>'col-sm-2 control-label')); ?>
		<div class="col-sm-10">
			<?php echo $form->textField($model,'books',array('class'=>'form-control','size'=>60,'maxlength'=>100,'alt'=>Tag::TAG_BOOK,'placeholder'=>'你平时看书吗？不管生活节奏有多快，平时有多忙，一定要多看一点书噢～','title'=>'喜欢的的书籍')); ?>
			<div class="selectItems">
				<?php echo Tag::model()->generateTags($model->books);?>
			</div>
			<?php echo $form->error($model,'books'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'sports',array('class'=>'col-sm-2 control-label')); ?>
		<div class="col-sm-10">
			<?php echo $form->textField($model,'sports',array('class'=>'form-control','size'=>60,'maxlength'=>100,'alt'=>Tag::TAG_SPORT,'placeholder'=>'你平时喜欢一些什么样的运动？蓝球，乒乓球，游泳……','title'=>'喜欢的运动')); ?>
			<div class="selectItems">
				<?php echo Tag::model()->generateTags($model->sports);?>
			</div>
			<?php echo $form->error($model,'sports'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'stars',array('class'=>'col-sm-2 control-label')); ?>
		<div class="col-sm-10">
		<?php echo $form->textField($model,'stars',array('class'=>'form-control','size'=>60,'maxlength'=>100,'alt'=>Tag::TAG_STAR,'placeholder'=>'你是大米，玉米？是凉粉还是冰粉？你丫喜欢啥星？','title'=>'喜欢的明星')); ?>
		<div class="selectItems">
			<?php echo Tag::model()->generateTags($model->stars);?>
		</div>
		<?php echo $form->error($model,'stars'); ?>
		</div>	
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'games',array('class'=>'col-sm-2 control-label')); ?>
		<div class="col-sm-10">
			<?php echo $form->textField($model,'games',array('class'=>'form-control','size'=>60,'maxlength'=>100,'alt'=>Tag::TAG_GAME,'placeholder'=>'你平时玩网游，单机版的小游戏？','title'=>'喜欢的游戏')); ?>
			<div class="selectItems">
				<?php echo Tag::model()->generateTags($model->games);?>
			</div>
			<?php echo $form->error($model,'games'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'digital',array('class'=>'col-sm-2 control-label')); ?>
		<div class="col-sm-10">
			<?php echo $form->textField($model,'digital',array('class'=>'form-control','size'=>60,'maxlength'=>100,'alt'=>Tag::TAG_DIGIT,'placeholder'=>'你喜欢摄影吗？想要一款好的手机吗？你会特别想要什么品牌的数码产品呢？','title'=>'喜欢的数码产品')); ?>
			<div class="selectItems">
				<?php echo Tag::model()->generateTags($model->digital);?>
			</div>
			<?php echo $form->error($model,'digital'); ?>
		</div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'others',array('class'=>'col-sm-2 control-label')); ?>
		<div class="col-sm-10">
			<?php echo $form->textField($model,'others',array('class'=>'form-control','size'=>60,'maxlength'=>100,'alt'=>Tag::TAG_OTHER,'placeholder'=>'你还有其他的什么爱好吗？与大家分享一下呸','title'=>'其他的爱好')); ?>
			<div class="selectItems">
				<?php echo Tag::model()->generateTags($model->others);?>
			</div>
			<?php echo $form->error($model,'others'); ?>
		</div>
	</div>

	<div class="form-group">
	    <div class="col-sm-offset-2 col-sm-10">
	     	<button type="submit" class="btn btn-primary"><?php echo $model->isNewRecord ? 'Created' : 'Save';?></button>
	     	<input type="text" id="tempRecord" />
	    </div>
 	 </div>	
	</div>
	<div class="col-sm-2">

	</div>

<?php $this->endWidget(); ?>
<!-- form -->