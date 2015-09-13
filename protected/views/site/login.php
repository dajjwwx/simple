<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - '.Yii::t('basic','Login');
$this->breadcrumbs=array(
	Yii::t('basic','Login'),
);
?>

<?php 
	$this->widget('ext.slider.BannerWidget');
?>
<div id="loginBox" class="container">
	<div class="col-md-9">
	&nbsp;
	</div>
	<div class="col-md-3" id="loginPanel" style="padding:20px;">
		<h3 class="page-header" style="margin-top:10px;">
			<span class="glyphicon glyphicon-user"></span>
			<?php echo Yii::t('basic','Login');?>
		</h3>	
		<!--<p><?php echo Yii::t('basic','Please fill out the following form with your login credentials:');?></p>-->
		<?php $this->renderPartial('_login',array('model'=>$model));?>
		<br />
		<p>还没有帐号？现在就<a href="<?php echo $this->createUrl('/site/register');?>">注册</a>一个吧！</p>
	</div>
</div>
