<?php foreach($model as $data):?>
	<span class="item">
		<a href="javascript:void(0);" class="provinceItem" onclick="YKG.app('form').singleChoice($(this),'Gaokao_paper');" id="<?php echo $data->id; ?>"><?php echo $data->name; ?></a>
	</span> | 
<?php endforeach;?>