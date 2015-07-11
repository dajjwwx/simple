<?php

class DefaultController extends Controller
{
	
	public $layout='//layouts/gaokao';
	
	public function actionIndex()
	{
		$this->render('index');
	}
}