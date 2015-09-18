<?php
/* @var $this SiteController */
/* @var $error array */

$this->pageTitle=Yii::app()->name . ' - Error';
$this->breadcrumbs=array(
	'Error',
);
?>

<div style="text-align:center;margin-top:100px;">

	<h1> Argh, No!</h1>
	<h1>Error <span style="font-size:120px;"><?php echo $code; ?></span></h1>

	<div class="error">
		<p><?php echo CHtml::encode($message); ?></p>
		<p><a href="/">返回主页</a></p>
	</div>
</div>
