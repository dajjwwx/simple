<?php
return array(
		'default'=>array(
				'menu'=>Yii::app()->getModule('test')->t('admin','Test'),
				'id'=>'default',
				'items'=>array(
					array('name'=>Yii::app()->getModule('test')->t('admin','Test Information'),'link'=>'user/admin')	,
					array('name'=>Yii::app()->getModule('test')->t('admin','Test Information'),'link'=>'category/index'),
					array('name'=>Yii::app()->getModule('test')->t('admin','Test Password'),'link'=>array('user/modifypassword','id'=>Yii::app()->user->id)),
					array('name'=>Yii::app()->getModule('test')->t('admin','Messages Test'),'link'=>'email/admin')
			)		
		),
		'file'=>array(
				'menu'=>Yii::app()->getModule('test')->t('admin','File Management'),
				'id'=>'file',
				'items'=>array(
						array('name'=>Yii::app()->getModule('test')->t('admin','Local Files'),'link'=>'file/admin'),
						array('name'=>Yii::app()->getModule('test')->t('admin','Qi Niu'),'link'=>'file/qiniu')
				)
		),
);
?>