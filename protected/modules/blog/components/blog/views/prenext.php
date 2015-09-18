<div class="container-fluid clearfix">
	<br />
	<div class="pull-left">
	<?php if(Blog::model()->getPreviewNews($this->id)):?>
		前一篇：<?php echo CHtml::link(UtilString::strSlice(Blog::model()->getPreviewNews($this->id)->title,0,$this->length),array('view','id'=>Blog::model()->getPreviewNews($this->id)->id,'t'=>urlencode(Blog::model()->getPreviewNews($this->id)->title)));?>
	<?php else:?>
		已经是第一篇了！
	<?php endif;?>
	</div>
	
	<div class="pull-right">
		<?php if(Blog::model()->getNextNews($this->id)):?>
			后一篇：<?php echo CHtml::link(UtilString::strSlice(Blog::model()->getNextNews($this->id)->title,0,$this->length),array('view','id'=>Blog::model()->getNextNews($this->id)->id,'t'=>urlencode(Blog::model()->getNextNews($this->id)->title)));?>
		<?php else:?>
			已经是最后一篇了，没有了！
		<?php endif;?>
	</div>
</div>
