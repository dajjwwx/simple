<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - '.Yii::t('basic','Login');
$this->breadcrumbs=array(
	'Login',
);
?>
<div class="container" style="background:#FFFFFF url(/public/image/loginbg.png) no-repeat top left;">
	<div class="col-md-6">
	&nbsp;
	</div>
	<div class="col-md-6">
		<h1 class="page-header" style="margin-top:100px;">
			<span class="glyphicon glyphicon-user"></span>
			<?php echo Yii::t('basic','Login');?>
		</h1>	

		<div class="col-md-8">
			<p><?php echo Yii::t('basic','Please fill out the following form with your login credentials:');?></p>
			<?php $this->renderPartial('_login',array('model'=>$model));?>
		</div>
		<div class="col-md-4">
			<h4>还没有帐号？</h4>
			<p>现在就<a href="<?php echo $this->createUrl('/site/register');?>">注册</a>一个吧！</p>
		</div>
	</div>
</div>
