<?php
class UtilUploader {
	
	public static function PLupload()
	{

	}
	
	public static function keyExchange(&$value, $key, $prefix='file_')
	{
		$value =  $prefix.$value;
		
		
	}
	
	public static function jqueryUpload($name, $folder, $pid, $fileext='*.jpg;*.png;*.gif', $prefix = 'file_' )
	{
		//If directory doesnot exists create it.  
		$output_dir = "./public/upload/";		
		
		  
		if(isset($_FILES[$name]))  
		{  
		    $ret = array();  
		  
		    $error =$_FILES[$name]["error"];  
		   {  
		      
		        if(!is_array($_FILES[$name]['name'])) //single file  
		        {  
		        	UtilHelper::writeToFile("Single",'a+');
		        	UtilHelper::writeToFile($_FILES,'a+');
		        	
		            $fileName = $_FILES[$name]["name"];  
		            move_uploaded_file($_FILES[$name]["tmp_name"],$output_dir. $_FILES[$name]["name"]);  
		            
		            self::uploadify($name, $folder, $pid, $fileext, $prefix);
		             //echo "<br> Error: ".$_FILES[$name]["error"];  
		               
		                 $ret[$fileName]= $output_dir.$fileName;  
		        }  
		        else  
		        {  
		        	
		              $fileCount = count($_FILES[$name]['name']);  
		              
		              UtilHelper::writeToFile("Array33333".$fileCount,'a+');
		        	
		              UtilHelper::writeToFile($_FILES,'a+');
		              
		              for($i=0; $i < $fileCount; $i++)  
		              {  
		                $fileName = $_FILES[$name]["name"][$i];  
		                 $ret[$fileName]= $output_dir.$fileName;    
		                 
		                 
		                move_uploaded_file($_FILES[$name]["tmp_name"][$i],$output_dir.$fileName );  
		              }  
		          
		        }  
		    }  
		    
		    UtilHelper::writeToFile($ret,'a+');
		    
		    echo json_encode($ret); 	
		}	
	}
	
	
	/**
	 * 使用ext.upload.Muploadify.MUploadify
	 * 
	 * ************************************************************************************************
	 * @param string $name
	 * @param string $prefix
	 * @throws CHttpException
	 */
     
     public static function uploadifyCheck()
     {
		$fileArray = array();
		foreach ($_POST as $key => $value) {
			if ($key != 'folder') {
				if (file_exists($_SERVER['DOCUMENT_ROOT'] . $_POST['folder'] . '/' . $value)) {
					$fileArray[$key] = $value;
				}
			}
		}
		
		$result['fileArray'] = $fileArray;
		
//		UtilHelper::writeToFile($result, 'a+');
		echo json_encode($fileArray);        
     }

     /**
      * 此方法为简单的文件上传，其中使用FileModel类的相应获取路径的方法
      *********************************************************************************
      * @param $name
      * @param $folder
      * @param $fileext
      * 
      * @return json
      */
     public static function simpleUpload($name, $folder, $fileext='*.jpg;*.png;*.gif')
     {
     	$result = array();
     	
     	$response = array(
     		'error'=>true
     	);
     	
     	try{
		
			$tempFile = $_FILES[$name]['tmp_name'];					
		
			$fileext = explode( ';', $fileext);
		
			$result['Ext'] = $fileext;			
			
			$now = time();
			
			
			$picture = CUploadedFile::getInstanceByName($name);
     		$model = new FileModel();
			$links = md5(date('ymdhis', $now).$picture->getName());
			$extension = strtolower($picture->getExtensionName());
//			$model->setDefaultValue($now, $links, $extension);
			
			$model->extension = $extension;
			$model->name = $picture->getName();
			$model->created = $now;
			
			$targetFile = $model->generateFilePath($folder,true, false);
			
			
			$result['FileModel'] = $model;
		
			$result['Path']=array(
					'tempName'=>$tempFile,
					'targetFile'=>$targetFile
			);			
				
				
			//验证文件格式
			if (in_array(strtolower('*.'.$model->extension),$fileext))
			{
				// Uncomment the following line if you want to make the directory if it doesn't exist
				// mkdir(str_replace('//','/',$targetPath), 0755, true);
		
				if(!$picture->saveAs($targetFile))
					throw new CHttpException(500);
					
				$response = array(
						'error'=>false,
						'path'=>$targetFile,
						'created'=>$now,
						'extension'=>$extension,
						'links'=>$links,
						'mime'=>CFileHelper::getMimeType($picture->getName())
					);
		
				
		
					// 							echo str_replace($_SERVER['DOCUMENT_ROOT'],'',$targetFile);
						
				$result['Response'] = $response;		
				
				
			}
				
		}catch(CException $e){
			$result['ERROR'] = $e->getMessage().$e->getTraceAsString();
				
		}
		UtilHelper::writeToFile(__LINE__,'a+');
		UtilHelper::writeToFile($result,'a+');
		
		return $response;
		
		
     }
     
     /**
      * ************************************************************************************
      * 本地文件上传前的准备数据
      * ************************************************************************************
      * @param string $name
      * @param int $pid
      * @return array
      */
     private static function prepareFiledata($name, $pid)
     {
     	$picture = CUploadedFile::getInstanceByName($name);
     		
     	$now = time();
     	$dataArray = array(
     			'pid'=>$pid,
     			'created'=>$now,
     			'ext'=>strtolower($picture->getExtensionName()),
     			'name'=>$picture->getName(),
     			'size'=>$picture->getSize(),
     			'mine'=>CFileHelper::getMimeType($picture->getName()),
     			'links'=>md5(date('ymdhis', $now).$picture->getName()),
     			'owner'=>Yii::app()->user->id,
     			'isfolder'=>0,
     			'hits'=>0,
     			'type'=>File::FILE_TYPE_BLOG,
     			'status'=>File::FILE_STATUS_PUBLISHED,
     			'islocal'=>File::FILE_ISLOCAL,
     			'server'=>File::model()->getServer()
     				
     	);     	
     	
     	UtilHelper::writeToFile($dataArray,'a+');
     	
     	return $dataArray;
     }
     
     /**
      * 实现File模型数据的重组
      * @param string $name
      * @param int $pid
      */    
     private static function fileData($name,$pid, $prefix)
     {
     	$dataArray = self::prepareFiledata($name, $pid);
     	
     	///重组数组dataArray 开始
     		
     	$keys = array_keys($dataArray);
     		
     	array_walk($keys, 'UtilUploader::keyExchange',$prefix);
     		
     	$values = array_values($dataArray);
     		
     	$dataArray = array_combine($keys, $values);
     	//重组数组dataArray结束
     	
     	return $dataArray;
     }
     
     /**
      * 本地文件上传WEB服务器
      * 注：此方法包含了两个内容，一个是文件的保存，另一个则是文件内容的保存，使用很不方便，故将此方法中的文件内容保存去掉
      * @since 2014/3/27 23:29	
      ******************************************************************************** 
      * 
      * @param string $name
      * @param string $folder
      * @param int $pid
      * @param string $fileext
      * @param string $prefix
      * @throws CHttpException
      */
	public static function uploadLocal($name, $folder, $pid, $fileext='*.jpg;*.png;*.gif', $prefix = 'file_' )
	{
		$result = array();
		
		$result['REQUEST'] = $_REQUEST;
		$result['FILES'] = $_FILES;	
		UtilHelper::writeToFile($result,'a+');
				
		try{
		
			$tempFile = $_FILES[$name]['tmp_name'];					
			$fileext = explode( ';', $fileext);		
			$result['Ext'] = $fileext;			
			
			UtilHelper::writeToFile(__LINE__,'a+');			
			UtilHelper::writeToFile($_FILES,'a+');	

			//文件上传前的数据准备
			$dataArray = self::fileData($name, $pid, $prefix);
			$result['dataArray'] = $dataArray;		

			UtilHelper::writeToFile($result,'a+');
			
		
			$model = new File();			
			

			$model->attributes = $dataArray;
			
			$file_links = $prefix.'links';
			$model->$file_links = $dataArray['file_links'];
		
			$result['Model'] = $model->attributes;			
			
			$targetFile = File::model()->attributeAdapter($model)->generateFilePath($path=$folder, $isUploadPath=true, $isThumb=true, $thumbOption=array());
// 			$targetFile = File::model()->generateFilePath($model, true, false, $folder);
		
			$result['Path']=array(
					'tempName'=>$tempFile,
					'targetFile'=>$targetFile
			);			
	
			if ($model->save())
			{			
				
				$id = $model->file_id;
				//验证文件格式
				if (in_array(strtolower('*.'.$model->file_ext),$fileext))
				{
					// Uncomment the following line if you want to make the directory if it doesn't exist
					// mkdir(str_replace('//','/',$targetPath), 0755, true);
					
					$picture = CUploadedFile::getInstanceByName($name);
		
					if(!$picture->saveAs($targetFile))
						throw new CHttpException(500);
						
					$response = array(
							'state'=>'success',
							'name'=>$model->file_name,
							'path'=>$targetFile,
							'id'=>$model->file_id
					);
		
					echo json_encode($response);
						
					$result['Response'] = $response;
				}
			}
			else 
			{
				UtilHelper::writeToFile($model->errors,'a+');
			}
				
		}catch(CException $e){
			$result['ERROR'] = $e->getMessage().$e->getTraceAsString();
				
		}			
		UtilHelper::writeToFile($result, 'a+');			
		Yii::app()->end();
	}
	
	/**
	 * **********************************************************************************************
	 * 实现文件的通用上传（可以本地上传到服务器，或者同步服务器的文件到文件云服务器如七牛或百度）
	 * 注意：
	 * 此方法的使用需要修改以下几个地方
	 * 1.在config/main.php中配置fileServer项，默认为local，即上传到web服务器
	 * 2.修改File模型，添加file_server属性
	 * 
	 * @since	2014/6/27 20:22
	 * **********************************************************************************************
	 * @param string $name			//文件名
	 * @param string $folder		//文件保存目录
	 * @param int $pid				//文件分类ID
	 * @param string $fileext		//文件后缀
	 * @param string $prefix		//属性前缀
	 */
	public static function upload($name, $folder, $pid,$fileServer='', $fileext='*.jpg;*.png;*.gif', $prefix = 'file_' )
	{
		if ($fileServer=='') {
			$fileServer = Yii::app()->params['fileServer'];
		}
		
		
		switch ($fileServer){
			
			case File::FILE_SERVER_LOCAL:
				self::uploadLocal($name, $folder, $pid,$fileext,$prefix);
				break;
			case File::FILE_SERVER_QINIU:
				self::uploadQiniu();
				break;
			
		}
	}
	
	
	// public static function uploadQiniu()
	// {
		
	// }
	
     /**
      * 文件上传
      * @param string $name
      * @param string $folder
      * @param int $pid
      * @param string $fileext
      * @param string $prefix
      * @throws CHttpException
      */
	public static function uploadify($name, $folder, $pid, $fileext='*.jpg;*.png;*.gif', $prefix = 'file_' )
	{
		$result = array();
		
		$result['REQUEST'] = $_REQUEST;
		$result['FILES'] = $_FILES;	
				
		try{
		
			$tempFile = $_FILES[$name]['tmp_name'];
		
//			$folder = $_POST['folder'];
					
			//传递参数
			//$data = json_decode($_REQUEST[$name]);
		
//			$result[$name] = $data;
		
//			$fileext = explode( ';', $_REQUEST['fileext']);
		
			$result['Ext'] = $fileext;
			
			$picture = CUploadedFile::getInstanceByName($name);
			
			$now = time();
			$dataArray = array(
					'pid'=>$pid,
					'created'=>$now,
					'ext'=>strtolower($picture->getExtensionName()),
					'name'=>$picture->getName(),
					'size'=>$picture->getSize(),
					'mine'=>CFileHelper::getMimeType($picture->getName()),
					'links'=>md5(date('ymdhis', $now).$picture->getName()),
					'owner'=>Yii::app()->user->id,
					'isfolder'=>0,
					'hits'=>0,
					'type'=>Category::CATEGORY_MEDIA,
					'status'=>File::FILE_STATUS_PUBLISHED,
					'islocal'=>File::FILE_ISLOCAL
					
				);
					
					

			
			///重组数组dataArray 开始
			
			$keys = array_keys($dataArray);
			
			array_walk($keys, 'UtilUploader::keyExchange',$prefix);
			
			
			
			$values = array_values($dataArray);			
			
			$dataArray = array_combine($keys, $values);
			//重组数组dataArray结束	

			
			
			
			$result['dataArray'] = $dataArray;
			
			
		
			$model = new File();
			
			$model->attributes = $dataArray;
			
			$file_links = $prefix.'links';
			$model->$file_links = $dataArray['file_links'];
			
			
			
// 			$model->file_pid =$data->id;
// 			$model->file_created = time();
// 			$model->file_ext = strtolower($picture->getExtensionName());
// 			$model->file_name = $picture->getName();
// 			$model->file_size = $picture->getSize();
// 			$model->file_mine = CFileHelper::getMimeType($picture->getName());
// 			$model->file_links = md5(date('ymdhis',$model->file_created).$picture->getName());
// 			$model->file_owner = Yii::app()->user->id;
// 			$model->file_isfolder = 0;
// 			$model->file_hits = 0;
// 			$model->file_type = Category::CATEGORY_MEDIA;
// 			$model->file_status = File::FILE_STATUS_PUBLISHED;
// 			$model->file_islocal = File::FILE_ISLOCAL;
		
			$result['Model'] = $model->attributes;
			
			
			
			$targetFile = File::model()->generateFilePath($model, true, false,$folder);
		
			$result['Path']=array(
					'tempName'=>$tempFile,
					'targetFile'=>$targetFile
			);
			
			
		
		
			
		
		
			if ($model->save())
			{
				$id = $model->file_id;
				//验证文件格式
				if (in_array(strtolower('*.'.$model->file_ext),$fileext))
				{
					// Uncomment the following line if you want to make the directory if it doesn't exist
					// mkdir(str_replace('//','/',$targetPath), 0755, true);
		
					if(!$picture->saveAs($targetFile))
						throw new CHttpException(500);
						
					$response = array(
							'state'=>'success',
							'name'=>$model->file_name,
							'path'=>$targetFile,
							'id'=>$model->file_id
					);
		
					echo json_encode($response);
		
					// 							echo str_replace($_SERVER['DOCUMENT_ROOT'],'',$targetFile);
						
					$result['Response'] = $response;
				}
			}
				
		}catch(CException $e){
			$result['ERROR'] = $e->getMessage().$e->getTraceAsString();
				
		}
			
		UtilHelper::writeToFile($result, 'a+');
		
			
		Yii::app()->end();
	}
}

?>