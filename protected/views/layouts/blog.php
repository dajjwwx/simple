<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
<div class="container">
	<div class="row" style="margin-top:60px;"></div>
	<div class="row-fluid">
		<div class="col-md-8">
						<?php if(isset($this->breadcrumbs)):?>
						<?php $this->widget('application.components.BootBreadcrumbs', array(
							'links'=>$this->breadcrumbs,
							'homeLink'=>'<li>'.CHtml::link(Yii::t('zii','Home'),'/').'</li>'
						)); ?><!-- breadcrumbs -->
					<?php endif?> 
			<?php echo $content; ?>
		</div>
		<div class="col-md-4">		
			<div class="panel panel-default">
				<div class="panel-heading">SideBar</div>
				<div class="panel-body">
				<?php
					$this->beginWidget('zii.widgets.CPortlet', array(
						'title'=>'Operations',
					));
					$this->widget('zii.widgets.CMenu', array(
						'items'=>$this->menu,
						'htmlOptions'=>array('class'=>'operations'),
					));
					$this->endWidget();
				?>				
				</div>
			</div>
			
			<div class="panel panel-default">
				<div class="panel-heading"><?php echo Yii::t('blog','Categories');?></div>
				<div class="panel-body">
					<div class=" widget">
					<?php
						$this->widget('blog.components.blog.BlogLatest',array(
							'htmlOptions'=>array(
								'style'=>'margin-left:-20px'
							)
						));
					?>				
					</div>
				</div>
			</div>	
			
			<div class="panel panel-default">
				<div class="panel-heading"><?php echo Yii::t('blog','Categories');?></div>
				<div class="panel-body">
					<div class=" widget">
					<?php
// 						echo Category::model()->generateCheckTreeByType(Category::CATEGORY_BLOG,array('treeview'=>Category::TREE_VIEW_LINK,'link'=>'space/list'));
					?>			
						<?php
							$this->widget('books.extensions.treeview.TreeViewWidget',array(
									'type'=>Category::CATEGORY_BLOG,
									'link'=>'/blog/space/list'
							));							
						?>		
					</div>
				</div>
			</div>		
			
			<div class="panel panel-default">
				<div class="panel-heading"><?php echo Yii::t('blog','Tags');?></div>
				<div class="panel-body">
					<div class=" widget">
					<?php echo Tag::model()->generateTagsCloud(Tag::TAG_BLOG,30,'/blog/space/tags');?>
					</div>
				</div>
			</div>			
		</div>
	</div>
</div>
<?php $this->endContent(); ?>