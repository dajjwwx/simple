<?php

class DefaultController extends Controller
{
	
	public $layouts = '//layouts/blog';
	
	
	public function actionIndex()
	{
		$file=file_get_contents('http://www.sina.com.cn/');
		preg_match('/<head>([\s\S]*)<\/head>/',$file,$head);
		print_r($head[0]);
		
		die();
		echo '<body><div class="rightbox"><div class="right">
<div class="colpadding"><div id="news" class="md">';
		preg_match('/<div id=\"news\" class=\"md\">([\s\S]*)
<span id=\"news_con_2\" style=\"display:none;\"><\/span>/',$file,$body);
		print_r($body[1]);
		echo '<span id="news_con_2" style="display:none;"></span>';
		echo '</div></div></div></div></body></html>';
		
		$this->render('index');
	}
	
	public function actionQQ()
	{
		$file=file_get_contents('http://www.sina.com.cn/');
		preg_match('/<body>([\s\S]*)<\/body>/',$file,$head);
		print_r($head);
	}
}