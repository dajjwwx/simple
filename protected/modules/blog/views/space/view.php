<?php
/* @var $this SpaceController */
/* @var $model Blog */

$this->menu=array(
	array('label'=>'List Blog', 'url'=>array('index')),
	array('label'=>'Create Blog', 'url'=>array('create')),
	array('label'=>'Update Blog', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Blog', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Blog', 'url'=>array('admin')),
);

$pid = explode(',', $model->cids);
$pid = $pid[0];
$menu = array_reverse(Category::model()->generateBreadcrumbs($pid));

$this->breadcrumbs = array_merge($this->breadcrumbs,$menu);
$this->breadcrumbs = array_merge($this->breadcrumbs,array(UtilString::strSlice($model->title,0,50)));

$this->pageTitle = Category::model()->generatePageTitle(array_reverse($this->breadcrumbs,'_')).Yii::app()->name;

//	 $this->widget('ext.editor.syntaxhighlighter.syntaxhighlighterWidget',array(
//		'theme'=>'Django'
//));
?>
<?php $this->widget('blog.extensions.syntaxhighlighter.syntaxhighlighterWidget');?>
<div class="panel panel-default">
	<div class="panel-body">
	<?php 
// 	$this->widget('application.components.blog.blogPreNext',array(
// 		'id'=>$model->id
// 	));
	?>
            <div class="post">
                <h2>
                	<?php echo UtilString::strSlice($model->title,0,20);?>
                </h2>
                <ul class="post-meta">
					<li class="author">By <a href="./blog.html"><?php echo $model->owner->username;?></a></li>
                    <li class="date"><?php echo date('Y年m月d日 h:i:s', $model->pubdate);?></li>
                    <?php if ($model->tags):?>
                    <li class="tags">
                    <?php echo Tag::model()->generateTags($model->tags, '','','-','space/tags',array());?>
                    </li>
                    <?php endif;?>
                    <li class="comments"><a href="./blog.html">有<?php echo count($model->comment);?>条评论</a></li>
                    <?php if(!Yii::app()->user->isGuest):?><li class="modify"><?php echo UtilAuth::getAuthLinks('修改', array('update','id'=>$model->id));?> / <?php echo UtilAuth::getAuthLinks('删除',array('delete','id'=>$model->id,'ajax'=>1),array('class'=>'blog-delete','onclick'=>'return false;'))?></li><?php endif;?>
                </ul>
                <div class="post-entry">
					<?php echo CHtml::decode(str_replace('toolbar:false', 'toolbar:true', $model->content));?>					
                </div>
                <?php 
					$this->widget('blog.components.blog.BlogPreNext',array(
						'id'=>$model->id
					));
				?>
            </div>


	
	<?php 
// 	$this->widget('application.components.visitors.visitorsWidget',array(
// 		'queryID' => $model->id
// 	));
	?>
	
	
	<?php /*	
	<?php if (!Yii::app()->user->isGuest):?>
	最近访客：<br />
		<?php foreach ($visitors as $vdata):?>
		<?php //UtilTools::dump($vdata->attributes);?>
		<?php echo Visitors::model()->getVisitorHead(long2ip($vdata->visitors_ip),array('style'=>'width:50px;'), '最后访问时间:'.date('Y-m-d h:i:s', $vdata->visitors_lasttime));?>
		<?php endforeach;?>
	<?php endif;?>
	*/
	?>

	<?php  //$this->widget('ext.idTabs.idTabsWidget'); ?>
	
	<!-- Nav tabs -->
	<ul class="nav nav-tabs" role="tablist">
	  <li class="active"><a href="#comment-list" role="tab" data-toggle="tab">相关评论</a></li>
	  <li><a href="#comment" role="tab" data-toggle="tab">评一评</a></li>
	</ul>	
	<!-- Tab panes -->
	<div class="tab-content">
		<br />
	  <div class="tab-pane active" id="comment-list">
	  	<?php
	  	 $this->widget('application.components.comment.CommentWidget',array(
	  					'view'=>'list',
						'id'=>$model->id,
						'type'=>Comment::COMMENT_TYPE_BLOG,
						'status'=>Comment::COMMENT_PUBLISHED
	  	));
	  	?>	  	
	  </div>
	  <div class="tab-pane" id="comment">
	  	<?php
	  		 $this->widget('application.components.comment.CommentWidget',array(
	  					'view'=>'form',
						'id'=>$model->id,
						'type'=>Comment::COMMENT_TYPE_BLOG
	  	));
?>
	  </div>
	</div>
	</div>
</div>