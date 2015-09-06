<?php $this->beginContent('//layouts/base');?>
	<?php $this->renderPartial('//layouts/nav');?>
		<?php echo $content;?>
	<div class="footer" style="background-color:black;padding:10px;margin-top:100px;">
      <div class="container">
        <p class="text-muted">Psdlace sticky footer content here.</p>
      </div>
    </div>
    <script type="text/javascript">var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cspan id='cnzz_stat_icon_1256010894'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "s4.cnzz.com/z_stat.php%3Fid%3D1256010894%26show%3Dpic' type='text/javascript'%3E%3C/script%3E"));</script>
<?php $this->endContent();?>
