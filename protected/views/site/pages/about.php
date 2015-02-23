<?php
/* @var $this SiteController */

$this->pageTitle= Yii::t('basic','About').' - '.Yii::app()->name;
$this->breadcrumbs=array(
	Yii::t('basic','About'),
);
?>
<div class="container" >
	<div class="row" style="margin-top:60px;">
		<h1 class="page-header"><?php echo Yii::t('basic', 'About');?></h1>

		<p>This is a "static" page. You may change the content of this page
		by updating the file <code><?php echo __FILE__; ?></code>.</p>
	</div>
</div>
