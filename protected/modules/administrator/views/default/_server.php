
<?php 
	$info = array(
			array('name'=>$this->module->t('admin','PHP UNAME'),'value'=>php_uname()),
			array('name'=>$this->module->t('admin','SERVER SOFTWARE'),'value'=>$_SERVER['SERVER_SOFTWARE']),
			array('name'=>$this->module->t('admin','HTTP HOST'),'value'=>$_SERVER["HTTP_HOST"]),
			array('name'=>$this->module->t('admin','ZEND VERSION'), 'value'=>zend_version()),
			array('name'=>$this->module->t('admin','SERVER NAME'),'value'=>gethostbyname($_SERVER[SERVER_NAME])),
			array('name'=>$this->module->t('admin','SERVER ADDR'),'value'=>$_SERVER['SERVER_ADDR']),
			array('name'=>$this->module->t('admin','SERVER PORT'),'value'=>$_SERVER['SERVER_PORT']),
			array('name'=>$this->module->t('admin','REMOTE_ADDR'),'value'=>$_SERVER['REMOTE_ADDR']),
			array('name'=>$this->module->t('admin','PROCESSOR IDENTIFIER'),'value'=>$_SERVER["PROCESSOR_IDENTIFIER"]),
			array('name'=>$this->module->t('admin','SYSTEM ROOT'),'value'=>$_SERVER['SystemRoot']),
			array('name'=>$this->module->t('admin','CURRENT PATH'),'value'=>__FILE__)
	);
?>

<div class="panel panel-default">
	<div class="panel-heading"><?php echo $this->module->t('admin','Server Infomartion');?></div>
<ul class="list-group">
	<?php foreach ($info as $item):?>
	<li class="list-group-item"><STRONG><?php echo $item['name'];?>:</STRONG> <?php echo $item['value']; ?></li>
	<?php endforeach;?>
</ul>
</div>
