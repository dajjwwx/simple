<?php foreach ($list as $blog):?>
<li>
		<a href="<?php echo Yii::app()->createUrl('news/view',array('id'=>$blog->arc_id,'title'=>urlencode($blog->arc_title)));?>">
			<h4><?php echo UtilTools::strSlice($blog->arc_title,0,$this->length);?></h4>
		</a>
        <span class="date"><?php echo UtilHelper::timeFormat($blog->arc_created)?></span>
        <p><?php echo UtilTools::strSlice($blog->arc_content,0,150);?></p>
</li>
<?php endforeach;?>