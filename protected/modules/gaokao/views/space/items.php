	<h5> 已经上传的试卷,如需重新上传，请先删除文件</h5>
	<ul style="margin:0px;padding:0px;">
		<li class="text-overflow" style="list-style:none;float:left;width:180px;margin:10px;padding:5px;background-color:#FFFFFF;border:1px solid grey;">
			<div style="text-align:center;font-size:16px;">
				<?php //echo Gaokao::model()->getPaperLink($province,$model->course,$model->year); ?>				
				<?php echo $model->file->name;?><br />
				<b>注:</b>本试卷适用于<?php echo Gaokao::model()->getProvincesScope($model->papername->provinces,false);?>
				<br />
				<?php if(UtilAuth::isLogin($model->file->owner)):?>
				<a href="<?php echo $this->createUrl('space/view',array('id'=>$model->id));?>">查看</a> / 
				<a href="<?php echo $this->createUrl('space/delete',array('id'=>$model->id,'fid'=>$model->fid));?>" onclick="deletePaper($(this));return false;">删除</a>
				<?php endif;?>
			</div>
		</li>
		<?php if($model->paperkey): ?>
		<?php $model = $model->paperkey;?>
		<li id="<?php echo $model->id;?>" onclick="$('#Gaokao_pid').val($(this).attr('id'));" class="text-overflow" style="list-style:none;float:left;width:180px;margin:10px;padding:5px;background-color:#FFFFFF;border:1px solid grey;">
			<div style="text-align:center;font-size:16px;">
				<?php //echo Gaokao::model()->getPaperLink($province,$model->course,$model->year); ?>				
				<?php echo $model->file->name;?><br />
				<b>注:</b>本试卷适用于<?php echo Gaokao::model()->getProvincesScope($model->papername->provinces,false);?>
				<br />
				<?php if(UtilAuth::isLogin($model->file->owner)):?>
				<a href="<?php echo $this->createUrl('space/view',array('id'=>$model->id));?>">查看</a> / 
				<a href="<?php echo $this->createUrl('space/delete',array('id'=>$model->id,'fid'=>$model->fid));?>" onclick="deletePaper($(this));return false;">删除</a>
				<?php endif;?>
			</div>
		</li>
		<?php else: ?>
		<li id="<?php echo $model->id;?>" onclick="$('#Gaokao_pid').val($(this).attr('id'));" class="text-overflow" style="list-style:none;float:left;width:180px;margin:10px;padding:5px;background-color:#FFFFFF;border:1px solid grey;">
			<div style="text-align:center;font-size:16px;">
				<button type="button" class="btn"  id="<?php echo $model->id;?>" onclick="uploadPaperKey($(this));" >上传答案解析</button>
			</div>
		</li>
		<?php endif;?>
	</ul>
	<hr style="clear:both;"/>