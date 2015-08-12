<?php foreach($model as $data):?>
	<span class="item <?php echo $_GET['paper']==$data->id?'border:1px solid grey;':'';?>" style="<?php echo $_GET['paper']==$data->paper?'border:1px solid grey;':'';?>">
		<a href="javascript:void(0);" class="provinceItem" onclick="YKG.app('form').singleChoice($(this),'CoursePaper_paper');" id="<?php echo $data->id; ?>"><?php echo $data->name; ?></a>
	</span> | 
<?php endforeach;?>