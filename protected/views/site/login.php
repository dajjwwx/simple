<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Login',
);
?>
<div class="container">

	<h1 class="page-header" style="margin-top:200px;"><?php echo Yii::t('basic','Login');?></h1>	
	<div class="col-md-4">
		<p><?php echo Yii::t('basic','Please fill out the following form with your login credentials:');?></p>
		<?php $this->renderPartial('_login',array('model'=>$model));?>
	</div>
	<div class="col-md-4">
		<h3>还没有帐号？</h3>
		<p>现在就<a href="<?php echo $this->createUrl('/site/register');?>">注册</a>一个吧！</p>
	</div>
</div>
