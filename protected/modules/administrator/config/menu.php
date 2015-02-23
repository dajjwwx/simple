<?php
return array(
		'default'=>array(
				'menu'=>Yii::app()->getModule('administrator')->t('admin','Basic Operation'),
				'id'=>'default',
				'items'=>array(
					array('name'=>Yii::app()->getModule('administrator')->t('admin','User Information'),'link'=>'user/admin')	,
					array('name'=>Yii::app()->getModule('administrator')->t('admin','Category Information'),'link'=>'category/index'),
					array('name'=>Yii::app()->getModule('administrator')->t('admin','Modify Password'),'link'=>array('user/modifypassword','id'=>Yii::app()->user->id)),
					array('name'=>Yii::app()->getModule('administrator')->t('admin','Messages'),'link'=>'email/admin')
			)		
		),
		'email'=>array(
				'menu'=>Yii::app()->getModule('administrator')->t('admin','Feed Back'),
				'id'=>'email',
				'items'=>array(
						array('name'=>Yii::app()->getModule('administrator')->t('admin','Messages'),'link'=>'email/admin'),
						array('name'=>Yii::app()->getModule('administrator')->t('admin','Send Message'),'link'=>'email/create')
				)				
		),
		'user'=>array(
				'menu'=>Yii::app()->getModule('administrator')->t('admin','User Management'),
				'id'=>'user',
				'items'=>array(
						array('name'=>Yii::app()->getModule('administrator')->t('admin','User Information'), 'link'=>'user/admin'),
						array('name'=>Yii::app()->getModule('administrator')->t('admin','User Profile'),'link'=>array('user/profile','id'=>Yii::app()->user->id)),
						array('name'=>Yii::app()->getModule('administrator')->t('admin','Create User'), 'link'=>'user/create'),
						array('name'=>Yii::app()->getModule('administrator')->t('admin','Modify Password'),'link'=>array('user/modifypassword','id'=>Yii::app()->user->id)),
				),
		),
		'category'=>array(
				'menu'=>Yii::app()->getModule('administrator')->t('admin','Category Management'),
				'id'=>'category',
				'items'=>array(
						array('name'=>Yii::app()->getModule('administrator')->t('admin','Category Information'),'link'=>'category/admin'),
						array('name'=>Yii::app()->getModule('administrator')->t('admin','Create Category'),'link'=>'category/create'),
				)				
		),
		'file'=>array(
				'menu'=>Yii::app()->getModule('administrator')->t('admin','File Management'),
				'id'=>'file',
				'items'=>array(
						array('name'=>Yii::app()->getModule('administrator')->t('admin','Local Files'),'link'=>'file/local'),
						array('name'=>Yii::app()->getModule('administrator')->t('admin','Qi Niu'),'link'=>'file/qiniu')
				)	
		),
		'video'=>array(
				'menu'=>Yii::app()->getModule('administrator')->t('admin','Video Management'),
				'id'=>'video',
				'items'=>array(
						array('name'=>Yii::app()->getModule('administrator')->t('admin','Video Information'),'link'=>'video/index'),
						array('name'=>Yii::app()->getModule('administrator')->t('admin','Video Keywords'),'link'=>'video/keywords')
				)		
		)

);