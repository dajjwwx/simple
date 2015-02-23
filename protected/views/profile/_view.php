<?php
/* @var $this ProfileController */
/* @var $data Profile */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('uid')); ?>:</b>
	<?php echo CHtml::encode($data->uid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('firstname')); ?>:</b>
	<?php echo CHtml::encode($data->firstname); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lastname')); ?>:</b>
	<?php echo CHtml::encode($data->lastname); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nickname')); ?>:</b>
	<?php echo CHtml::encode($data->nickname); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('avatar')); ?>:</b>
	<?php echo CHtml::encode($data->avatar); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('gender')); ?>:</b>
	<?php echo CHtml::encode($data->gender); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('calendar')); ?>:</b>
	<?php echo CHtml::encode($data->calendar); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('birth')); ?>:</b>
	<?php echo CHtml::encode($data->birth); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('birthyear')); ?>:</b>
	<?php echo CHtml::encode($data->birthyear); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('birthmonth')); ?>:</b>
	<?php echo CHtml::encode($data->birthmonth); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('birthday')); ?>:</b>
	<?php echo CHtml::encode($data->birthday); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('blood')); ?>:</b>
	<?php echo CHtml::encode($data->blood); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('marry')); ?>:</b>
	<?php echo CHtml::encode($data->marry); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('email')); ?>:</b>
	<?php echo CHtml::encode($data->email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('phone')); ?>:</b>
	<?php echo CHtml::encode($data->phone); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('qq')); ?>:</b>
	<?php echo CHtml::encode($data->qq); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('alipay')); ?>:</b>
	<?php echo CHtml::encode($data->alipay); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('job')); ?>:</b>
	<?php echo CHtml::encode($data->job); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('companyname')); ?>:</b>
	<?php echo CHtml::encode($data->companyname); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('companyaddress')); ?>:</b>
	<?php echo CHtml::encode($data->companyaddress); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('primaryschool')); ?>:</b>
	<?php echo CHtml::encode($data->primaryschool); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('middleschool')); ?>:</b>
	<?php echo CHtml::encode($data->middleschool); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('highschool')); ?>:</b>
	<?php echo CHtml::encode($data->highschool); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('university')); ?>:</b>
	<?php echo CHtml::encode($data->university); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('country')); ?>:</b>
	<?php echo CHtml::encode($data->country); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('province')); ?>:</b>
	<?php echo CHtml::encode($data->province); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('manicipal')); ?>:</b>
	<?php echo CHtml::encode($data->manicipal); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('village')); ?>:</b>
	<?php echo CHtml::encode($data->village); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('county')); ?>:</b>
	<?php echo CHtml::encode($data->county); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('homeprovince')); ?>:</b>
	<?php echo CHtml::encode($data->homeprovince); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('homemanicipal')); ?>:</b>
	<?php echo CHtml::encode($data->homemanicipal); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('homecounty')); ?>:</b>
	<?php echo CHtml::encode($data->homecounty); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('homevillage')); ?>:</b>
	<?php echo CHtml::encode($data->homevillage); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('addressdetail')); ?>:</b>
	<?php echo CHtml::encode($data->addressdetail); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('homeaddressdetail')); ?>:</b>
	<?php echo CHtml::encode($data->homeaddressdetail); ?>
	<br />

	*/ ?>

</div>