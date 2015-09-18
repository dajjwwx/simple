<?php
/* @var $this SpaceController */
/* @var $model Books */

$this->breadcrumbs=array(
	'Books'=>array('index'),
	$model->info->title,
);

$this->menu=array(
	array('label'=>'List Books', 'url'=>array('index')),
	array('label'=>'Create Books', 'url'=>array('create')),
	array('label'=>'Update Books', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Books', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Books', 'url'=>array('admin')),
);
?>

<div class="panel panel-default">
	<div class="panel-heading">
		<span class="glyphicon glyphicon-paperclip"></span> <?php echo $model->info->title; ?>
	</div>
	<div class="panel-body">
			<div class="row">
				<div class="col-md-5">
					<img src="<?php echo DouBanBookInfo::getLargeImage($model->info->image);?>" class="img-thumbnail" width="100%"/>
				</div>
				<div class="col-md-2">				
					<div class="panel panel-default">
						<div class="panel-heading">当前库存</div>
						<div class="panel-body">
							<p>余 <span class="badge">114</span> 本</p>
						</div>
					</div>
				</div>
				<div class="col-md-5">
						<p>书名：<em id="title" style="color:red;font-size:18px;font-weight:bolder;"><?php echo $model->info->title;?></em></p>
						<p>作者：<span id="author"><?php echo $model->info->author;?></span></p>
						<p>价格：&yen;<span id="price"><?php echo $model->info->price;?></span>元</p>
						<p>出版社：<span id="publisher"><?php echo $model->info->publisher;?></span></p>
						<p>书籍分类：<span id="bookcategory" class="editable" contenteditable="true" onclick="showCategories($(this));return false;" data-href="<?php echo $this->createUrl('bookcategory',array('id'=>$model->shelf->id));?>">分类</span></p>
						<hr />
						<div id="categoryList"></div>
				</div>
<script type="text/javascript">
					
	function showCategories(object)
	{
		var href=object.attr('data-href');
		$('#categoryList').load(href);
		return false;
	}
					
</script>

				<div class="col-md-12">
					<br />
					<!-- Nav tabs -->
					<ul class="nav nav-tabs" role="tablist">
					  <li role="presentation" class="active"><a href="#home" role="tab" data-toggle="tab">其他书库</a></li>
					  <li role="presentation"><a href="#catelog" role="tab" data-toggle="tab">目录</a></li>
					  <li role="presentation"><a href="#summary" role="tab" data-toggle="tab">简介</a></li>
					</ul>					
					<br />					
					<!-- Tab panes -->
					<div class="tab-content">
					  <div role="tabpanel" class="tab-pane active" id="home">		
						 <?php 
						 $this->widget('zii.widgets.CListView', array(
							'dataProvider'=>$dataProvider,
							'itemView'=>'_book_list_view',
						)); ?> 
					  </div>
					  <div role="tabpanel" class="tab-pane" id="catelog"><?php echo is_null($model->info->catelog)?'没有目录':$model->info->catelog;?></div>
					  <div role="tabpanel" class="tab-pane" id="summary">

					  	
					  	</div>
					</div>	
				</div>
			</div>
			

	
		<?php 
// 		$this->widget('zii.widgets.CDetailView', array(
// 			'data'=>$model->info,
// 			'attributes'=>array(
// 				'id',
// 		'title',
// 		'origin_title',
// 		'subtitle',
// 		'pubdate',
// 		'isbn10',
// 		'isbn13',
// 		'author',
// 		'image',
// 		'summary',
// 		'tags',
// 		'catelog',
// 		'binding',
// 		'translator',
// 		'pages',
// 		'publisher',
// 		'alt_title',
// 		'author_intro',
// 		'price',
// 			),
// 		)); ?>
	</div>
</div>
