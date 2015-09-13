<?php $this->beginContent('//layouts/base');?>
	<?php $this->renderPartial('//layouts/nav');?>
		<?php echo $content;?>
	<div class="footer"  id="footer">
		<div class="container">
	      		  <p class="text-muted" style="text-align:center;">
	      		  	<a href="<?php echo $this->createUrl('/site/page',array('view'=>'about'));?>"><?php echo Yii::t("basic","About");?></a>  |  
	      		  	<a href="<?php echo $this->createUrl('/site/contact');?>"><?php echo Yii::t("basic","Contact");?></a>  |
	      		  	<script type="text/javascript">var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cspan id='cnzz_stat_icon_1256010894'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "s4.cnzz.com/z_stat.php%3Fid%3D1256010894%26show%3Dpic' type='text/javascript'%3E%3C/script%3E"));</script>
					<br />
	      		  	<span>&copy;2015 Yuekegu All Rights Reserved</span>
	      		  	<span>蜀ICP备15018913号-1</span>
	      		  	
	      		  </p>  
	     	 </div>
	 </div>
 <?php $this->endContent();?>
