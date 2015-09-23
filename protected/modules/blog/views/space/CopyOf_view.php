<?php
/* @var $this SpaceController */
/* @var $data Blog */
?>
            <div class="post">
                <h2>
                	<?php echo CHtml::link(CHtml::encode(UtilString::strSlice($data->title,0,20)),array('space/view','id'=>$data->id,'t'=>urlencode($data->title)));?>
                </h2>
                <ul class="post-meta">
					<li class="author">By <a href="./blog.html"><?php echo $data->owner->username;?></a></li>
                    <li class="date"><?php echo date('Y年m月d日 h:i:s', $data->pubdate);?></li>
                    <?php if ($data->tags):?>
                    <li class="tags">
                    <?php echo Tag::model()->generateTags($data->tags, '','','-',array('space/tags'),array());?>
                    </li>
                    <?php endif;?>
                    <li class="comments"><a href="./blog.html">有<?php //echo count($data->comment);?>条评论</a></li>
                    <?php if(!Yii::app()->user->isGuest):?><li class="modify"><?php echo UtilAuth::getAuthLinks('修改', array('update','id'=>$data->id));?>--<?php echo UtilAuth::getAuthLinks('删除',array('delete','id'=>$data->id,'ajax'=>1),array('class'=>'blog-delete','onclick'=>'return false;'))?></li><?php endif;?>
                </ul>
                <div class="post-entry">
					<?php echo UtilString::strSlice(strip_tags($data->content),0,250);?>
                </div>
            </div>