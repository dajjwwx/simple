<?php
class UtilUeditor
{
	
	/**
	 * 抓取远程图片
	 * User: Jinqn
	 * Date: 14-04-14
	 * Time: 下午19:18
	 */
	public static function actionCrawler($CONFIG)
	{

		set_time_limit(0);
		
		/* 上传配置 */
		$config = array(
				"pathFormat" => $CONFIG['catcherPathFormat'],
				"maxSize" => $CONFIG['catcherMaxSize'],
				"allowFiles" => $CONFIG['catcherAllowFiles'],
				"oriName" => "remote.png"
		);
		$fieldName = $CONFIG['catcherFieldName'];
		
		/* 抓取远程图片 */
		$list = array();
		if (isset($_POST[$fieldName])) {
			$source = $_POST[$fieldName];
		} else {
			$source = $_GET[$fieldName];
		}
		foreach ($source as $imgUrl) {
			$item = new UEditorUploader($imgUrl, $config, "remote");
			$info = $item->getFileInfo();
			array_push($list, array(
			"state" => $info["state"],
			"url" => $info["url"],
			"size" => $info["size"],
			"title" => htmlspecialchars($info["title"]),
			"original" => htmlspecialchars($info["original"]),
			"source" => htmlspecialchars($imgUrl)
			));
		}
		
		/* 返回抓取数据 */
		return json_encode(array(
				'state'=> count($list) ? 'SUCCESS':'ERROR',
				'list'=> $list
		));		
	}
	
	/**
	 * 上传附件和上传视频
	 * User: Jinqn
	 * Date: 14-04-09
	 * Time: 上午10:17
	 */
	public static function actionUpload($CONFIG)
	{
		/* 上传配置 */
		$base64 = "upload";
		switch (htmlspecialchars($_GET['action'])) {
			case 'uploadimage':
				$config = array(
				"pathFormat" => $CONFIG['imagePathFormat'],
				"maxSize" => $CONFIG['imageMaxSize'],
				"allowFiles" => $CONFIG['imageAllowFiles']
				);
				$fieldName = $CONFIG['imageFieldName'];
				break;
			case 'uploadscrawl':
				$config = array(
				"pathFormat" => $CONFIG['scrawlPathFormat'],
				"maxSize" => $CONFIG['scrawlMaxSize'],
				"allowFiles" => $CONFIG['scrawlAllowFiles'],
				"oriName" => "scrawl.png"
						);
						$fieldName = $CONFIG['scrawlFieldName'];
						$base64 = "base64";
						break;
			case 'uploadvideo':
				$config = array(
				"pathFormat" => $CONFIG['videoPathFormat'],
				"maxSize" => $CONFIG['videoMaxSize'],
				"allowFiles" => $CONFIG['videoAllowFiles']
				);
				$fieldName = $CONFIG['videoFieldName'];
				break;
			case 'uploadfile':
			default:
				$config = array(
				"pathFormat" => $CONFIG['filePathFormat'],
				"maxSize" => $CONFIG['fileMaxSize'],
				"allowFiles" => $CONFIG['fileAllowFiles']
				);
				$fieldName = $CONFIG['fileFieldName'];
				break;
		}
		
		UtilHelper::writeToFile($config);
		
		/* 生成上传实例对象并完成上传 */
		$up = new UEditorUploader($fieldName, $config, $base64);
		
		/**
		 * 得到上传文件所对应的各个参数,数组结构
		 * array(
		 *     "state" => "",          //上传状态，上传成功时必须返回"SUCCESS"
		 *     "url" => "",            //返回的地址
		 *     "title" => "",          //新文件名
		 *     "original" => "",       //原始文件名
		 *     "type" => ""            //文件类型
		 *     "size" => "",           //文件大小
		 * )
		*/
		
		/* 返回数据 */
		return json_encode($up->getFileInfo());		
	}
	/**
	 * 获取已上传的文件列表
	 * User: Jinqn
	 * Date: 14-04-09
	 * Time: 上午10:17
	 */
	public static function actionList($CONFIG)
	{
		/* 判断类型 */
		switch ($_GET['action']) {
			/* 列出文件 */
			case 'listfile':
				$allowFiles = $CONFIG['fileManagerAllowFiles'];
				$listSize = $CONFIG['fileManagerListSize'];
				$path = $CONFIG['fileManagerListPath'];
				break;
				/* 列出图片 */
			case 'listimage':
			default:
				$allowFiles = $CONFIG['imageManagerAllowFiles'];
				$listSize = $CONFIG['imageManagerListSize'];
				$path = $CONFIG['imageManagerListPath'];
		}
		$allowFiles = substr(str_replace(".", "|", join("", $allowFiles)), 1);
		
		/* 获取参数 */
		$size = isset($_GET['size']) ? htmlspecialchars($_GET['size']) : $listSize;
		$start = isset($_GET['start']) ? htmlspecialchars($_GET['start']) : 0;
		$end = $start + $size;
		
		/* 获取文件列表 */
		$path = $_SERVER['DOCUMENT_ROOT'] . (substr($path, 0, 1) == "/" ? "":"/") . $path;
		$files = self::getfiles($path, $allowFiles);
		if (!count($files)) {
			return json_encode(array(
					"state" => "no match file",
					"list" => array(),
					"start" => $start,
					"total" => count($files)
			));
		}
		
		/* 获取指定范围的列表 */
		$len = count($files);
		for ($i = min($end, $len) - 1, $list = array(); $i < $len && $i >= 0 && $i >= $start; $i--){
			$list[] = $files[$i];
		}
		//倒序
		//for ($i = $end, $list = array(); $i < $len && $i < $end; $i++){
		//    $list[] = $files[$i];
		//}
		
		/* 返回数据 */
		$result = json_encode(array(
				"state" => "SUCCESS",
				"list" => $list,
				"start" => $start,
				"total" => count($files)
		));
		
		return $result;		
	}

	/**
	 * 远程抓取
	 * @param $uri
	 * @param $config
	 */
	public static function getRemoteImage( $uri,$config)
	{
	    //忽略抓取时间限制
	    set_time_limit( 0 );
	    //ue_separate_ue  ue用于传递数据分割符号
	    $imgUrls = explode( "ue_separate_ue" , $uri );
		$tmpNames = array();
		foreach ( $imgUrls as $imgUrl ) {
    		//http开头验证
    		if(strpos($imgUrl,"http")!==0){
				array_push( $tmpNames , "error" );
	    	continue;
			}
			//获取请求头
			$heads = get_headers( $imgUrl );
			//死链检测
			if ( !( stristr( $heads[ 0 ] , "200" ) && stristr( $heads[ 0 ] , "OK" ) ) ) {
			    array_push( $tmpNames , "error" );
			    continue;
			}
		
			//格式验证(扩展名验证和Content-Type验证)
			$fileType = strtolower( strrchr( $imgUrl , '.' ) );
			if ( !in_array( $fileType , $config[ 'allowFiles' ] ) || stristr( $heads[ 'Content-Type' ] , "image" ) ) {
			    array_push( $tmpNames , "error" );
			    continue;
			}
	
			//打开输出缓冲区并获取远程图片
			ob_start();
			$context = stream_context_create(
			    array (
			        'http' => array (
			            'follow_location' => false // don't follow redirects
			        )
			    )
			);
			//请确保php.ini中的fopen wrappers已经激活
			readfile( $imgUrl,false,$context);
			$img = ob_get_contents();
			ob_end_clean();
		
			//大小验证
			$uriSize = strlen( $img ); //得到图片大小
			$allowSize = 1024 * $config[ 'maxSize' ];
			if ( $uriSize > $allowSize ) {
			    array_push( $tmpNames , "error" );
			    continue;
			}
			//创建保存位置
			$savePath = $config[ 'savePath' ];
			if ( !file_exists( $savePath ) ) {
			    mkdir( "$savePath" , 0777 );
			}
			//写入文件
			$tmpName = $savePath . rand( 1 , 10000 ) . time() . strrchr( $imgUrl , '.' );
			
			$pid = Lookup::model()->getUserDefaultAlbum(Yii::app()->user->id)->id;
			File::model()->saveRemoteFile($uri,$pid,'advertisement');
			
			try {
			    $fp2 = @fopen( $tmpName , "a" );
			    fwrite( $fp2 , $img );
			    fclose( $fp2 );
			    array_push( $tmpNames ,  $tmpName );
			} catch ( Exception $e ) {
			    array_push( $tmpNames , "error" );
			}
		}
		/**
		 * 返回数据格式
		 * {
		 *   'url'   : '新地址一ue_separate_ue新地址二ue_separate_ue新地址三',
		 *   'srcUrl': '原始地址一ue_separate_ue原始地址二ue_separate_ue原始地址三'，
		 *   'tip'   : '状态提示'
		 * }
		 */
		echo "{'url':'" . implode( "ue_separate_ue" , $tmpNames ) . "','tip':'远程图片抓取成功！','srcUrl':'" . $uri . "'}";
	}
	
	/**
	 * 遍历获取目录下的指定类型的文件
	 * @param $path
	 * @param array $files
	 * @return array
	 */
	function getfiles($path, $allowFiles, &$files = array())
	{
		if (!is_dir($path)) return null;
		if(substr($path, strlen($path) - 1) != '/') $path .= '/';
		$handle = opendir($path);
		while (false !== ($file = readdir($handle))) {
			if ($file != '.' && $file != '..') {
				$path2 = $path . $file;
				if (is_dir($path2)) {
					self::getfiles($path2, $allowFiles, $files);
				} else {
					if (preg_match("/\.(".$allowFiles.")$/i", $file)) {
						$files[] = array(
								'url'=> substr($path2, strlen($_SERVER['DOCUMENT_ROOT'])),
								'mtime'=> filemtime($path2)
						);
					}
				}
			}
		}
		return $files;
	}

	
	/**
	* 删除整个目录
	* @param $dir
	* @return bool
	*/
	function delDir( $dir )
	{
		//先删除目录下的所有文件：
		$dh = opendir( $dir );
		while ( $file = readdir( $dh ) ) {
		    if ( $file != "." && $file != ".." ) {
		        $fullpath = $dir . "/" . $file;
		        if ( !is_dir( $fullpath ) ) {
		            unlink( $fullpath );
		        } else {
		            delDir( $fullpath );
		        }
		    }
		}
		closedir( $dh );
		//删除当前文件夹：
		return rmdir( $dir );
	}
	
}
?>