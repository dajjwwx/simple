<?php $this->widget('zii.widgets.CListView', array(
			'dataProvider'=>$model,
			'itemView'=>'_view',
)); ?>

<script type="text/javascript">

		function trash(object)
		{
			var id = object.attr("data-id");
			var href = object.attr('data-href');
		
			$.get(href,function(data){				
				object.parent().parent().parent().parent().fadeOut(2000,function(){
					$(this).remove();
				});				
				console.log(data);				
			},'json');		
		
		}


		function update(object)
		{
			var id = object.attr("data-id");
			var href = object.attr('data-href');

			$.get(href,function(data){

				if(object.find('span').hasClass('glyphicon-ok-circle'))
					object.find('span').removeClass('glyphicon-ok-circle').addClass('glyphicon-ban-circle');
				else
					object.find('span').removeClass('glyphicon-ban-circle').addClass('glyphicon-ok-circle');
				
				object.parent().parent().append('<span class="tips">'+data.message+'</span>').find(".tips").fadeOut(2000,function(){
					$(this).remove();
				});
				
				console.log(data);				
			},'json');
			

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
						{name:'Comment[status]',value:'<?php echo Comment::COMMENT_PUBLISHED;?>'}
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