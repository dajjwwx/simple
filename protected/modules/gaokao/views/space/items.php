	<h5> 已经上传的试卷,如需重新上传，请先删除文件</h5>
	<ul style="margin:0px;padding:0px;">
		<?php foreach($model as $data):?>
		<li id="<?php echo $data->id;?>" onclick="$('#Gaokao_pid').val($(this).attr('id'));" style="list-style:none;float:left;width:180px;height:100px;margin:10px;padding:5px;background-color:#FFFFFF;border:1px solid grey;">
			<div style="text-align:center;font-size:16px;">
				<?php //echo Gaokao::model()->getPaperLink($province,$data->course,$data->year); ?>
				<?php echo $data->file->name;?>
				<b>注:</b>本试卷适用于<?php echo Gaokao::model()->getProvincesScope($data->papername->provinces,false);?>
				<br />
				<a href="<?php echo $this->createUrl('space/delete',array('id'=>$data->id,'fid'=>$data->file->id));?>">删除</a>
			</div>
		</li>
		<?php endforeach;?>
	</ul>
	<hr style="clear:both;"/>