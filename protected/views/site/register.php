<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - '.Yii::t('basic','Register');
$this->breadcrumbs=array(
	Yii::t('basic','Register'),
);
?>

<?php 
	$this->widget('ext.slider.BannerWidget');
?>
<div id="loginBox" class="container" style="height:200px;">
	<div class="col-md-9">
	&nbsp;
	</div>
	<div class="col-md-3" id="loginPanel" style="padding:20px;">
		<h3 class="page-header" style="margin-top:10px;">
			<span class="glyphicon glyphicon-user"></span>
			<?php echo Yii::t('basic','Register');?>
		</h3>	
		<?php if (Yii::app()->user->hasFlash('state')) :?>
			<?php echo Yii::app()->user->getFlash('state'); ?>
		<?php else:?>
			<!--<p><?php echo Yii::t('basic','Please fill out the following form with your favor:');?></p>-->
			<?php $this->renderPartial('_register',array('model'=>$model));?>
		<?php endif;?>
		<br />
		我有账号，现在<a href="<?php echo $this->createUrl('site/login');?>">登陆</a>
	</div>
</div>