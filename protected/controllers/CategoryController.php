<?php

class CategoryController extends Controller
{

	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='/layouts/blank';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','categoriesbytype'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	
// 	public function actions()
// 	{
// 		// return external action classes, e.g.:
// 		return array(
// 				'action1'=>'path.to.ActionClass',
// 				'action2'=>array(
// 						'class'=>'path.to.AnotherActionClass',
// 						'propertyName'=>'propertyValue',
// 				),
// 		);
// 	}
	
	public function actionIndex()
	{
		UtilHelper::dump(Category::model()->search());
		
		$models = Category::model()->findAll();
		
		UtilHelper::dump($models);		
		
		$this->render('index');
	}
	
	/**
	 * @todo 为分类联动下拉菜单生成数据
	 * @param int $type
	 */
	public function actionCategoriesByType($type)
	{		
		$list = Category::model()->getCategoryDropdownList($type);
		
		echo json_encode($list);
	}
	
	



}