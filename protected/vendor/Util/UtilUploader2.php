<?php
// include 'UtilUploader.php';

class UtilUploader2 extends UtilUploader
{
	/**
	 * ************************************************************************************
	 * 本地文件上传前的准备数据
	 * ************************************************************************************
	 * @param string $name
	 * @param int $pid
	 * @return array
	 */
	public static function prepareFiledata($name, $pid, $filetype=File::FILE_TYPE_BLOG)
	{
		$picture = CUploadedFile::getInstanceByName($name);
		$now = time();
		$dataArray = array(
				'pid'=>$pid,
				'created'=>$now,
				'extension'=>strtolower($picture->getExtensionName()),
				'name'=>$picture->getName(),
				'size'=>$picture->getSize(),
				//关于此处的使用在windows上用name而linux使用tempname
				'mine'=>CFileHelper::getMimeType($picture->getName()),
				'links'=>md5(date('ymdhis', $now).$picture->getName()),
				'owner'=>Yii::app()->user->id,
				'isfolder'=>0,
				'hits'=>0,
				'filetype'=>$filetype,
				'status'=>File::FILE_STATUS_PUBLISHED,
				'islocal'=>File::FILE_ISLOCAL,
				'server'=>File::model()->getServer()

		);
		// UtilHelper::writeToFile(__FILE__.__LINE__,'a+');
		// UtilHelper::writeToFile($dataArray,'a+');

		return $dataArray;
	}

	/**
	 * 实现File模型数据的重组
	 * @param string $name
	 * @param int $pid
	 */
	public static function fileData($name,$pid, $prefix)
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

	public static function setFileAttributes($name, $type, $pid=null, $prefix = '')
	{
		// $tempFile = $_FILES[$name]['tmp_name'];
		// $fileext = explode( ';', $fileext);
		// $result['Ext'] = $fileext;

		// UtilHelper::writeToFile(__LINE__,'a+');
		UtilHelper::writeToFile($_FILES,'a+');

		//文件上传前的数据准备
		$dataArray = self::fileData($name, $pid, $prefix);
		$dataArray[$prefix."filetype"] = $type;
		// $result['dataArray'] = $dataArray;

		// UtilHelper::writeToFile(__LINE__,'a+');
		// UtilHelper::writeToFile($result,'a+');

		$model = new File();
		$model->attributes = $dataArray;

		$file_links = 'links';
		$model->$file_links = $dataArray['links'];

		// $result['Model'] = $model->attributes;

		// $targetFile = File::model()->attributeAdapter($model)->getFilePath($folder, true, false);
		// 			$targetFile = File::model()->generateFilePath($model, true, false, $folder);

		// $result['Path']=array(
		// 		'tempName'=>$tempFile,
		// 		'targetFile'=>$targetFile
		// );
		//
		// print_r($result);


		return $model;
	}


	public static function uploadQiniu($name, $type,$folder,$pid=null,$fileext='*.jpg;*.png;*.gif', $prefix = '')
	{
			// $result = array();

			// $result['REQUEST'] = $_REQUEST;
			// $result['FILES'] = $_FILES;
			// UtilHelper::writeToFile($result,'a+');
			try{

				$model = self::setFileAttributes($name, $type, $pid, $prefix);

				// $targetFile = File::model()->attributeAdapter($model)->generateFilePath($model, true, false, $folder);
				$targetFile = File::model()->attributeAdapter($model)->getFilePath($folder, true, false);



				// $result['Path']=array(
				// 		'tempName'=>$tempFile,
				// 		'targetFile'=>$targetFile
				// );

				//
				// echo __LINE__.'  '.$targetFile;

				if ($model->save())
				{
					// UtilHelper::writeToFile($model->attributes,'w+',__LINE__,__FILE__);

					$id = $model->id;

					$tempFile = $_FILES[$name]['tmp_name'];
					$fileext = explode( ';', $fileext);

					$targetFile = File::model()->attributeAdapter($model)->getFilePath($folder, true, false);

					// UtilHelper::dump($tempFile.'==='.$targetFile);

					//验证文件格式
					if (in_array(strtolower('*.'.$model->extension),$fileext))
					{

						$qiniu = new \API\Qiniu();


						$data = $qiniu->putFile($targetFile,$tempFile);

						$response = array(
								'state'=>'success',
								'name'=>$model->name,
								'path'=>$targetFile,
								'id'=>$model->id,
								'data'=>$data
						);

						echo json_encode($response);

						// UtilHelper::writeToFile($response,'a+');

						// $result['Response'] = $response;
					}
				}
				else
				{
					// UtilHelper::dump($model->errors);
					// UtilHelper::writeToFile($model->errors,'a+');
				}

			}catch(CException $e){
				// $result['ERROR'] = $e->getMessage().$e->getTraceAsString();

			}
			// UtilHelper::writeToFile($result, 'a+');
			Yii::app()->end();
	}


	/**
	 * ****************************************************************************
	 * @todo 上传图片文件
	 * *****************************************************************************
	 * @uses UtilUploader2::uploadNormal('Filedata',File::FILE_TYPE_AVATAR,Yii::app()->params['uploadAvatarPath'],$pid);
	 * ***************************************************************************
	 *
	 * @param string $name
	 * @param string $fileext
	 * @param string $prefix
	 * @throws CHttpException
	 */
	public static function uploadNormal($name, $type,$folder,$pid=null,$fileext='*.jpg;*.png;*.gif', $prefix = '')
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
				$dataArray[$prefix."filetype"] = $type;
				$result['dataArray'] = $dataArray;

				UtilHelper::writeToFile(__LINE__,'a+');
				UtilHelper::writeToFile($result,'a+');

				$model = new File();
				$model->attributes = $dataArray;

				$file_links = 'links';
				$model->$file_links = $dataArray['links'];

				$result['Model'] = $model->attributes;

				$targetFile = File::model()->attributeAdapter($model)->getFilePath($folder, true, false);
				// 			$targetFile = File::model()->generateFilePath($model, true, false, $folder);

				$result['Path']=array(
						'tempName'=>$tempFile,
						'targetFile'=>$targetFile
				);

				if ($model->save())
				{

					$id = $model->id;
					//验证文件格式
					if (in_array(strtolower('*.'.$model->extension),$fileext))
					{
						// Uncomment the following line if you want to make the directory if it doesn't exist
						// mkdir(str_replace('//','/',$targetPath), 0755, true);

						$picture = CUploadedFile::getInstanceByName($name);

						if(!$picture->saveAs($targetFile))
							throw new CHttpException(500);

						$response = array(
								'state'=>'success',
								'name'=>$model->name,
								'path'=>$targetFile,
								'id'=>$model->id
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
	 * 本地文件上传WEB服务器
	 * 注：此方法包含了两个内容，一个是文件的保存，另一个则是文件内容的保存，使用很不方便，故将此方法中的文件内容保存去掉
	 * @since 2014/3/27 23:29
	 ********************************************************************************
	 *
	 *@uses UtilUploader2::uploadLocal('Filedata', Yii::app()->params['uploadBlogPath'], 1, $fileext='*.jpg;*.png;*.gif', $prefix = '');
	 **********************************************************************
	 * @param string $name
	 * @param string $folder
	 * @param int $pid
	 * @param string $fileext
	 * @param string $prefix
	 * @throws CHttpException
	 *
	 *
	 */
	public static function uploadLocal($name, $folder, $pid, $fileext='*.jpg;*.png;*.gif', $prefix = 'file_' )
	{
		$result = array();

		$result['REQUEST'] = $_REQUEST;
		$result['FILES'] = $_FILES;

		UtilHelper::writeToFile($result,'a+');

		UtilHelper::dump($result);


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

			$links = $prefix.'links';
			$model->$links = $dataArray[$prefix.'links'];

			$result['Model'] = $model->attributes;

			$targetFile = File::model()->attributeAdapter($model)->getFilePath($folder, true, false);
//

			$result['Path']=array(
					'tempName'=>$tempFile,
					'targetFile'=>$targetFile
			);

			if ($model->save())
			{

				$file_id = $prefix.'id';
				$file_ext = $prefix.'extension';
				$file_name = $prefix.'name';

				$id = $model->$file_id;
				//验证文件格式
				if (in_array(strtolower('*.'.$model->$file_ext),$fileext))
				{
					// Uncomment the following line if you want to make the directory if it doesn't exist
					// mkdir(str_replace('//','/',$targetPath), 0755, true);

					$picture = CUploadedFile::getInstanceByName($name);

					if(!$picture->saveAs($targetFile))
						throw new CHttpException(500);

					$response = array(
							'state'=>'success',
							'name'=>$model->$file_name,
							'path'=>$targetFile,
							'id'=>$model->$file_id
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


}