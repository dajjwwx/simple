	<h5> 已经上传的试卷</h5>
	<ul style="margin:0px;padding:0px;">
		<?php foreach($model as $data):?>
		<li id="<?php echo $data->id;?>" onclick="$('#Gaokao_pid').val($(this).attr('id'));" style="list-style:none;float:left;width:180px;height:100px;margin:10px;padding:5px;background-color:#FFFFFF;border:1px solid grey;">
			<div style="text-align:center;font-size:16px;">
				<?php //echo Gaokao::model()->getPaperLink($province,$data->course,$data->year); ?>
				<?php echo $data->file->name;?>
				<br />
				<b>注:</b>本试卷适用于<?php echo Gaokao::model()->getProvincesScope($data->papername->provinces);?>
			</div>
		</li>
		<?php endforeach;?>
	</ul>
	<hr style="clear:both;"/>