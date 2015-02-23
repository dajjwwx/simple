<?php if ($Y->action->id == 'view'):?>
	<div class="col-md-2 ">
		<div class="img-circle" style="background:url('<?php echo BookShelfInfo::model()->getBookShelfFolderByBookId(intval($_GET['id']),80);?>') no-repeat center center;width:80px;height:80px;margin:auto;"></div>
	</div>
<?php endif;?>