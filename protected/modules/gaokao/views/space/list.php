<?php foreach($courses as $course):?>
<a name="<?php echo $course['cname'];?>"></a>
<div class="panel panel-default">
<div class="panel-heading">
	<span class="glyphicon glyphicon-paperclip"></span> <?php echo $course['course'];?></div>
<div class="panel-body">
	<ul style="margin:0px;padding:0px;">
	<?php foreach($provinces as $k=>$province):?>
		<li style="list-style:none;float:left;width:180px;height:100px;margin:10px;padding:5px;background-color:#FFFFFF;border:1px solid grey;">
			<div style="margin-top:10px;text-align:center;font-size:18px;font-weight:bold;"><?php echo $province?></div>
			<br />
			<div style="text-align:center;font-size:16px;">
			<!--<a href="" style="color:grey;">试卷</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="" style="color:grey;">答案</a>-->
			<?php //echo $k.'-'.$course['id'];?>
			<?php echo Gaokao::model()->getPaperLink($k,$course['id'],$year); ?>
			</div>
		</li>
	<?php endforeach;?>
	</ul>
			
</div>
</div>
<?php endforeach;?>