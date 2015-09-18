<?php
/* @var $this SiteController */
/* @var $model ContactForm */
/* @var $form CActiveForm */

$this->pageTitle=Yii::app()->name . ' - '.Yii::t('basic', 'Contact');
$this->breadcrumbs=array(
		Yii::t('basic', 'Contact')
);
?>

<div class="container" >
	<div class="row" style="margin-top:60px;">
	<h1 class="page-header"><?php echo Yii::t('basic', 'Contact Us');?></h1>

	<?php if(Yii::app()->user->hasFlash('contact')): ?>

		<div class="flash-success">
			<?php echo Yii::app()->user->getFlash('contact'); ?>
		</div>

		<?php else: ?>
		<blockquote class="right-aligned">
			<p class="text-muted">
				<?php echo Yii::t('basic','If you have business inquiries or other questions, please fill out the following form to contact us. Thank you.');?>
			</p>
			<footer> <cite title="<?php echo Yii::app()->name;?>"><?php echo Yii::app()->name;?></cite>全体客服人员</footer>
		</blockquote>

		<div class="col-md-6">
			<?php $this->renderPartial('_contact',array('model'=>$model));?>
		</div>


		</div><!-- form -->

		<?php endif; ?>
	</div>
</div>