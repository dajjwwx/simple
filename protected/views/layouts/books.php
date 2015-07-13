<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
	<div class="container">
	
		<div class="row" style="margin-top:90px;opacity:0.9;">
			<?php 
			if($this->action->id !='index'){
				$this->widget('books.components.header.HeaderWidget');
			}
			?>	
		</div>
	
		<div class="row" style="margin-top:30px;opacity:0.9;">
			<div class="col-md-3">
				<div class="panel panel-default">
					<div class="panel-heading">
						<span class="glyphicon glyphicon-paperclip"></span> View Profile 
					</div>
					<div class="panel-body">
										
						<ul class="list-group">
							<li class="list-group-item"><?php echo CHtml::link('添加图书',array('space/addbooks'));?></li>
							<li class="list-group-item"><?php echo CHtml::link('我的书库',array('space/mybookshelf'));?></li>
						</ul>
					
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
					<div class="panel-heading"><?php echo Yii::app()->getModule('books')->t('books','Books Categories');?></div>
					<div class="panel-body">
						<div class=" widget">
						<?php
							$this->widget('ext.treeview.TreeViewWidget',array(
// 								'link'=>''
							));							
						?>				
						</div>
					</div>
				</div>	
			</div>
			<div class="col-md-9">
				<?php echo $content;?>
			</div>	
		</div>
		
		<script type="text/javascript">
		
		</script>
	</div>
<?php $this->endContent(); ?>