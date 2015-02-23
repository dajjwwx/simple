<?php

/**
 *
 * @author Administrator
 *        
 */
class ServiceController extends CController {
	
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
// 	public $layout='//layouts/column2';
	
	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
				'accessControl', // perform access control for CRUD operations
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
						'actions'=>array(),
						'users'=>array('*'),
				),
				array('allow', // allow authenticated user to perform 'create' and 'update' actions
						'actions'=>array('gettags','autosave','ueditor'),
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
	
	public function actionUEditor()
	{
		//header('Access-Control-Allow-Origin: http://www.baidu.com'); //设置http://www.baidu.com允许跨域访问
		//header('Access-Control-Allow-Headers: X-Requested-With,X_Requested_With'); //设置允许的跨域header
		date_default_timezone_set("Asia/chongqing");
		error_reporting(E_ERROR);
		header("Content-Type: text/html; charset=utf-8");
		
		global $CONFIG;
		
		$CONFIG = json_decode(preg_replace("/\/\*[\s\S]+?\*\//", "", file_get_contents(Yii::getPathOfAlias('application.config').'/ueditor.json')), true);

		$action = $_GET['action'];
		
		switch ($action) {
			case 'config':
				$result =  json_encode($CONFIG);
				break;		
				/* 上传图片 */
			case 'uploadimage':
				/* 上传涂鸦 */
			case 'uploadscrawl':
				/* 上传视频 */
			case 'uploadvideo':
				/* 上传文件 */
			case 'uploadfile':
				$result = UtilUeditor::actionUpload($CONFIG);
				break;
		
				/* 列出图片 */
			case 'listimage':
				$result = UtilUeditor::actionList($CONFIG);
				break;
				/* 列出文件 */
			case 'listfile':
				$result = UtilUeditor::actionList($CONFIG);
				break;
		
				/* 抓取远程文件 */
			case 'catchimage':
				$result = UtilUeditor::actionCrawler($CONFIG);
				break;
		
			default:
				$result = json_encode(array(
					'state'=> '请求地址出错'
				));
				break;
		}
		
		/* 输出结果 */
		if (isset($_GET["callback"])) {
			if (preg_match("/^[\w_]+$/", $_GET["callback"])) {
				echo htmlspecialchars($_GET["callback"]) . '(' . $result . ')';
			} else {
				echo json_encode(array(
						'state'=> 'callback参数不合法'
				));
			}
		} else {
			echo $result;
		}	

		Yii::app()->end();
	}
	
	public function actionGetTags()
	{
		
// 		$_POST['content'] = <<<DOM
//  		 测试内容： '旅行者1号（Voyager 1）是一艘无人外太阳系太空探测器，重815千克，于1977年9月5日发射。它曾到访过木星及土星，第一次提供了它们卫星的高解析度清晰照片。它是离地球最远和飞行速度最快的人造飞行器，真正意义上飞出了太阳系，首次进入星系空间。旅行者1号与其姊妹船旅行者2号携带的钚电池（核动力电池）将持续到2025年。当电池耗尽之后，他们会停止工作，将继续向着银河系的中心前进。2012年6月14日，美国航空航天局(NASA)宣布，“旅行者”1号探测器在经过长达33年的长途跋涉、飞行约合177亿公里之后，接近太阳系边缘。目前或已飞出太阳系。';
// DOM;
		
		$content = $_POST['content'];
		
		if(!isset($_POST['content']))
			throw new CHttpException(404,'The requested page does not exist.');

		
		echo UtilTags::getTags($content, 3);
	}
	
	public function actionAutoSave()
	{
		if (Yii::app()->user->isGuest)
			throw new CHttpException(404,'The requested page does not exist.');
		
		$data = $_POST;
		
		$data['from'] = Yii::app()->request->getUrlReferrer();
		
		$string = serialize($data);
				
		UtilAutoSave::saveAsFile($string);
	}
	
	public function actionTest()
	{
		UtilHelper::dump(UtilAutoSave::getAllAchiveInfo());
	}
	
}
?>
 