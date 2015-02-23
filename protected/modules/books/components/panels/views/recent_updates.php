<div class="panel panel-default">
	<div class="panel-heading">
		<span class="glyphicon glyphicon-paperclip"></span> <?php echo  Yii::app()->getModule('books')->t('books','Recent Updates');?> 
	</div>
	<div class="panel-body">
		  <div style="background:url(/public/image/books/breaker.png) 0px 5px repeat-y;">
				 <?php 
					 $this->widget('zii.widgets.CListView', array(
						'dataProvider'=>$data,
						'itemView'=>'_book_view',
					 		
// 						'template'=>"{items}\n{pager}",
						'itemsCssClass'=>'table table-hover table-condensed clearfix',
						'pagerCssClass'=>' pull-right',
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