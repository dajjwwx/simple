<table class="table table-condensed">
	<?php foreach ($list as $blog):?>
	<tr>
		<td><?php echo CHtml::link(UtilString::strSlice($blog->title,0,$this->length),array('/blog/view','id'=>$blog->id,'t'=>urlencode($blog->title)));?></td>
		<td><?php echo UtilDate::timeFormat($blog->pubdate);?></td>
	</tr>
	<?php endforeach;?>
</table>
