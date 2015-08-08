	<ul style="margin:0px;padding:0px;">
		<li style="list-style:none;float:left;width:180px;height:100px;margin:10px;padding:5px;background-color:#FFFFFF;border:1px solid grey;">
			<div style="margin-top:10px;text-align:center;font-size:18px;font-weight:bold;"><?php echo $province?></div>
			<br />
			<div style="text-align:center;font-size:16px;">
				<?php echo Gaokao::model()->getPaperLink($k,$course['id'],2015); ?>
			</div>
		</li>
	</ul>