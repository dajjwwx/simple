<?php
/* @var $this PaperController */
/* @var $data Paper */
?>

<li style="list-style:none;float:left;width:160px;height:180px;margin:10px;padding:5px;background-color:#FFFFFF;border:1px solid grey;">
	<div style="margin-top:10px;text-align:center;font-size:18px;font-weight:bold;"><?php echo $data->name;?></div>

	<div style="text-align:center;font-size:16px;">
		适用省份：<?php echo Gaokao::model()->getProvincesScope($data->provinces);?>
	</div>
</li>