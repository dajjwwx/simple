<?php $this->beginContent('//layouts/base');?>
	<?php $this->renderPartial('//layouts/nav');?>
		<?php echo $content;?>
	<div class="footer">
      <div class="container">
        <p class="text-muted">Psdlace sticky footer content here.</p>
      </div>
    </div>
<?php $this->endContent();?>
