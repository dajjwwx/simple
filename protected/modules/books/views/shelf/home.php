<div class="panel panel-default">
	<div class="panel-heading">
		<span class="glyphicon glyphicon-paperclip"></span> 书店装修
	</div>
	<div class="panel-body">
		<div class="row">
		  <div class="col-sm-6 col-md-6">
		    <div class="thumbnail">    
				<?php if ($data->info) :?>		
				<?php $album = BookShelfInfo::model()->getBookShelfFolder($data->id);?>		
				<?php echo CHtml::image($album, '单击上传图片',array('onclick'=>'$(".caption").show();'));?>	
			</div>
			<div class="row">
				<?php if($list):?>
				  <?php foreach ($list as $folder):?>
				  <div class="col-md-4">	
				  	<div class="close"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span>&nbsp;</div>
				    <a href="#" class="thumbnail" id="<?php echo $folder['id'];?>" onclick="updateFolder('<?php echo intval($_GET['id']);?>',$(this));" style="width:100%;height:80px;background:url(<?php echo $folder['src'];?>) no-repeat center center;">
						<img src="<?php echo $folder['src'];?>" style="width:0;" />
				    </a>
				  </div>
				<?php endforeach;?>
				<?php endif;?>
				</div>
		      	<?php else:?>
		     		 <img src="/public/image/books/bookshelf.jpg" alt="...">
		      	<?php endif;?>
		      <hr />
		      <p style="text-align:center;"><a class="btn btn-primary" href="#">收藏</a>  &nbsp;&nbsp;&nbsp;&nbsp; <a href="#" class="btn btn-primary">预订</a></p>
		  </div>
		  <div class="col-sm-6 col-md-6">
		    	<div>
			        <h3><span contenteditable="true" id="BookShelf[name]" class="editable"><?php echo CHtml::encode($data->name); ?></span><a href="<?php echo $this->createUrl('/books/space/addbooks',array('id'=>$_GET['id']));?>" class="btn btn-primary pull-right">添加图书</a> </h3>
			        <hr />
					<?php if ($data->info):?>  
					<p>
						<b><?php echo CHtml::encode($data->getAttributeLabel('address')); ?>:</b>
						<span contenteditable="true" id="BookShelf[address]" class="editable"><?php echo CHtml::encode($data->address); ?></span>
						<br />
					</p>			     
			        <div class="page-header"><b><?php echo CHtml::encode(Yii::t('books','Introduce'));?>:</b></div>
			        <p>&nbsp;
			        	<span id="BookShelfInfo[introduce]" contenteditable="true" class="editable"><?php echo is_null($data->info->introduce)?'没有简介~':$data->info->introduce;?></span>
			        </p>
					<?php else:?>
						<p>
							此书架还没装修哦~~
						</p>
					<?php endif;?>
			
			    </div>
			    <div class="page-header">
			    	Map
			    </div>
			    <?php //$this->renderPartial('_map');?>
			</div>
			<hr />
		</div>
		<hr />
		
		<!-- Nav tabs -->
		<ul class="nav nav-tabs" role="tablist">
		  <li role="presentation" class="active"><a href="#home" role="tab" data-toggle="tab">最近更新</a></li>
		  <li role="presentation"><a href="#profile" role="tab" data-toggle="tab">Profile</a></li>
		  <li role="presentation"><a href="#messages" role="tab" data-toggle="tab">Messages</a></li>
		</ul>
		
		<!-- Tab panes -->
		<div class="tab-content">
			<br />
		  <div role="tabpanel" class="tab-pane active" id="home" style="background:url(/public/image/books/breaker.png) 0px 5px repeat-y;height:495px;display:block;">

				 <?php 
					 $this->widget('zii.widgets.CListView', array(
						'dataProvider'=>$dataProvider,
						'itemView'=>'_view',
						//'template'=>"{items}\n{pager}",
						'itemsCssClass'=>'table table-hover table-condensed clearfix',
						'pagerCssClass'=>'pull-right clearfix',
						'pager'=>array(
								'selectedPageCssClass'=>'active',
								'maxButtonCount'=>12,
								'header'=>'',
								'htmlOptions'=>array(
										'class'=>'pagination',
								)
						)
					)); ?> 	
		  </div>
		  <div role="tabpanel" class="tab-pane" id="profile">...</div>
		  <div role="tabpanel" class="tab-pane" id="messages">...</div>
		</div>
	
	</div>
</div>		
