<div class="panel panel-default">
	<div class="panel-heading">
		<span class="glyphicon glyphicon-paperclip"></span> 畅读书籍 
	</div>
	<div class="panel-body">
		  <div style="background:url(/public/image/books/breaker.png) 0px 5px repeat-y;">
				 <?php 
					 $this->widget('zii.widgets.CListView', array(
						'dataProvider'=>$data,
						'itemView'=>'_book_view',
					 		
// 						'template'=>"{items}\n{pager}",
						'itemsCssClass'=>'table table-hover table-condensed clearfix',
						'pagerCssClass'=>' pull-right clearfix',
						'pager'=>array(
								'selectedPageCssClass'=>'active',
								'maxButtonCount'=>8,
								'header'=>'',
								'htmlOptions'=>array(
										'class'=>'pagination',
								)
						)
					)); ?> 	
		  </div>
	</div>
</div>