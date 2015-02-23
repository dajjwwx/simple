<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - '.Yii::t('basic','Register');
$this->breadcrumbs=array(
	Yii::t('basic','Register'),
);
?>
<div class="container">
	<h1 class="page-header" style="margin-top:100px;"><?php echo Yii::t('basic','Register');?></h1>
	<div class="col-md-4">
	<?php if (Yii::app()->user->hasFlash('state')) :?>
		<?php echo Yii::app()->user->getFlash('state'); ?>
	<?php else:?>
		<p><?php echo Yii::t('basic','Please fill out the following form with your favor:');?></p>
		<?php $this->renderPartial('_register',array('model'=>$model));?>
	<?php endif;?>
	</div>
	<div class="col-md-4">
	
	</div>
</div>