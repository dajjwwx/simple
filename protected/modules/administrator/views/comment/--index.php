<?php
/* @var $this CommentController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Comments',
);

$this->menu=array(
	array('label'=>'Create Comment', 'url'=>array('create')),
	array('label'=>'Manage Comment', 'url'=>array('admin')),
);
?>

<div class="panel panel-default">
	<div class="panel-heading">
		<h4><span class="glyphicon glyphicon-list"></span> Comments</h4>
	</div>
	<div class="panel-body">
		<?php $this->widget('zii.widgets.CListView', array(
			'dataProvider'=>$dataProvider,
			'itemView'=>'_view',
		)); ?>
	</div>
</div>

<?php 
function commentNested($model, &$html='')
{

	$html .= <<<DOM
		<div class="media">
		<a class="pull-left" href="#">
		<img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI2NCIgaGVpZ2h0PSI2NCI+PHJlY3Qgd2lkdGg9IjY0IiBoZWlnaHQ9IjY0IiBmaWxsPSIjZWVlIi8+PHRleHQgdGV4dC1hbmNob3I9Im1pZGRsZSIgeD0iMzIiIHk9IjMyIiBzdHlsZT0iZmlsbDojYWFhO2ZvbnQtd2VpZ2h0OmJvbGQ7Zm9udC1zaXplOjEycHg7Zm9udC1mYW1pbHk6QXJpYWwsSGVsdmV0aWNhLHNhbnMtc2VyaWY7ZG9taW5hbnQtYmFzZWxpbmU6Y2VudHJhbCI+NjR4NjQ8L3RleHQ+PC9zdmc+" style="width: 64px; height: 64px;" class="media-object" data-src="holder.js/64x64" alt="64x64">
		</a>
		<div class="media-body">
		<br />
		<p>
DOM;
	if ($model->status == Comment::COMMENT_PUBLISHED) {
		$html .= '<span class="glyphicon glyphicon-ok-circle"></span>';
	} elseif ($model->status == Comment::COMMENT_LOCK) {
		$html .= '<span class="glyphicon glyphicon-ban-circle"></span>';
	}

	$html .=  $model->content;
	
// 	$html .= '<small><a href="'.Yii::app()->createUrl('/administrator/comment/reply',array('id'=>$model->id)).'">回复</a></small>';
	
	$html .=  '<small>
      		 <a class="status" data-id="'.$model->id.'" data-href="'. Yii::app()->createUrl('/administrator/comment/reply',array('id'=>$model->id)).'" onclick="reply($(this));"  href="javascript:void(0);">
      			<span class="glyphicon glyphicon-ok-circle" title="通过审核"></span>
      		</a>
      		&nbsp;
      		<a class="reply" data-id="'.$model->id.'" data-href="'. Yii::app()->createUrl('/administrator/comment/reply',array('id'=>$model->id)).'" onclick="reply($(this),\''.Comment::COMMENT_TYPE_BLOG.'\');"  href="javascript:void(0);">
      			<span class="glyphicon glyphicon-send" title="回复"></span>
      		</a>
      		&nbsp;
      		<a class="delete" data-id="'. $model->id.'" data-href="'. Yii::app()->createUrl('/administrator/comment/reply',array('id'=>$model->id)).'" onclick="reply($(this));"  href="javascript:void(0);">
      			<span class="glyphicon glyphicon-trash" title="删除"></span>
      		</a>
      		
      	</small>
      	</p>';

	if($model->comments)
	{
		foreach ($model->comments as $data)
		{
			commentNested($data,$html);
		}
	}

	$html .= '
				
		</div>	
	</div>';

	return $html;


}
?>

<script type="text/javascript">

		function reply(object)
		{
			var id = object.attr("data-id");
			var href = object.attr('data-href');

			
		}

		function reply(object,type)
		{
			var id = object.attr("data-id");
			var href = object.attr('data-href');

			var body = object.parent().parent().parent();
			var top = body.parent();

			
			//检查是否已经加载回复文本框
			var has_reply_box = object.parent().parent().next().hasClass("media");
			if(has_reply_box == false) {
				var html = '<textarea class="form-control"></textarea><button type="button" class="btn btn-primary" style="margin-top:10px;">回复</button>';
				
				var newbox = top.clone();
				newbox.find(".media-body").html(html).find('button').click(function(){
					var content = newbox.find(".media-body").find("textarea").val();

					var data = [
						{name:'Comment[content]',value:content},
						{name:'Comment[pid]',value:id},			
						{name:'Comment[ctype]',value:type},			
						{name:'Comment[author]',value:'<?php echo Yii::app()->user->name;?>'},
						{name:'Comment[email]',value:'<?php echo Yii::app()->params->email;?>'},
					];

					console.log(data);
					
					$.post(href,data,function(msg){
						alert(msg.message);

						if(msg.status == 'success') {

							alert(content);
							object.parent().html(content);
							newbox.find(".media-body").html('<br /><p>' + content + '</p>');
						} else {
							alert(msg.message);
						}
						
						
					},'json');					

				});;
				newbox.appendTo(body);
			}
			



		}
</script>