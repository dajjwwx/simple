<div class="panel panel-default">
	<div class="panel-heading">
		<span class="glyphicon glyphicon-paperclip"></span> 畅读书籍 
	</div>
	<div class="panel-body">
				 <?php 
					 $this->widget('zii.widgets.CListView', array(
						'dataProvider'=>$data,
						'itemView'=>'_shelf_view',
					 		
// 						'template'=>"{items}\n{pager}",
						'itemsCssClass'=>'table table-hover table-condensed clearfix',
						'pagerCssClass'=>'pull-right clear',
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