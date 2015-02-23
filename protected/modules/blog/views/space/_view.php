<?php
/* @var $this SpaceController */
/* @var $data Blog */
?>
	<li class="post-item">
			<div class="author"><a href="./blog.html"><?php echo $data->owner->username;?></a></div>
			<div class="time"><?php echo date('m/d', $data->pubdate);?></div>
			<div class="number"></div>					
			<div class="panel panel-info post-content">
            	<div class="panel-heading post-heading">
                   <h4>
	                	<?php echo CHtml::link(CHtml::encode(UtilString::strSlice($data->title,0,20)),array('space/view','id'=>$data->id,'t'=>urlencode($data->title)));?>
	                </h4>	               
            	</div>
				<div class="panel-body post-body">
					<p>
					<?php echo UtilString::strSlice(strip_tags($data->content),0,250);?>
					</p>
				</div>
				<div class="panel-footer post-footer">
	                <ul class="post-meta">
	                    <?php if ($data->tags):?>
	                    <li class="tags">
	                    <?php echo Tag::model()->generateTags($data->tags, '','','-','space/tags',array());?>
	                    </li>
	                    <?php endif;?>
	                    <li class="comments"><a href="./blog.html">有<?php echo count($data->comment);?>条评论</a></li>
	                    <?php if(!Yii::app()->user->isGuest):?><li class="modify"><?php echo UtilAuth::getAuthLinks('修改', array('update','id'=>$data->id));?> / <?php echo UtilAuth::getAuthLinks('删除',array('delete','id'=>$data->id,'ajax'=>1),array('class'=>'blog-delete','onclick'=>'return false;'))?></li><?php endif;?>      		
	                    <li class="more"><a href="<?php echo $this->createUrl('space/view',array('id'=>$data->id));?>">阅读全文</a></li>
	                </ul>
				</div>
			</div>
	</li>