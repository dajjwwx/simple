<?php

class DefaultController extends Controller
{
	public $layout='//layouts/gaokao';
	
	public function actionIndex()
	{
		$this->render('index');
	}
	
	public function actionList()
	{
		$this->render('list');
	}	
	
	public function actionUpload()
	{
		
		$this->render('upload');
	}
}