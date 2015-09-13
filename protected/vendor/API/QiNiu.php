<?php

namespace API;

use Qiniu\Storage\UploadManager;
use Qiniu\Auth;
use Qiniu\Storage\BucketManager;

class Qiniu
{	

	private $domain;
	private $accessKey;
	private $secretKey;
	private $bucket;		
	private $token;
	private $auth;

	private $uploadManager;
	private $bucketManager;
	
	public function __construct($bucket = 'gaokao')
	{	
			
		$this->bucket = \Yii::app()->params['QiNiu'][$bucket]['bucket'];
		$this->domain = \Yii::app()->params['QiNiu'][$bucket]['domain'];
		$this->accessKey = \Yii::app()->params['QiNiu'][$bucket]['accessKey'];
		$this->secretKey = \Yii::app()->params['QiNiu'][$bucket]['secretKey'];

		// echo $this->accessKey.'---'.$this->secretKey.'<br />';

		$this->getToken();

			
	}

	protected function getToken()
	{
		$this->auth = new Auth($this->accessKey,$this->secretKey);

		$this->token = $this->auth->uploadToken($this->bucket);

		// var_dump($this->auth);
	}

	public function getUploadManager()
	{
		$this->uploadManager = new UploadManager();

		return $this;
	}

	public function getBucketManager()
	{
		$this->bucketManager = new BucketManager($this->auth);

		// var_dump($this->bucketManager);

		return $this;
	}

	/**
	 * 返回文件的键名
	 * @param File $model
	 * @param string $folder
	 * @return mixed
	 */
	public function getFileKey(File $model, $folder=null)
	{			
			
// 		UtilHelper::dump($model);

		if (is_null($folder)) {
			$folder = \Yii::app()->params->uploadFilePath;
		}		

		$model = File::model()->attributeAdapter($model, Yii::app()->params->uploadGaoKaoPath);
		
		$filename = $model->generateFilePath($folder, false, false);			

		return $filename;
			
	}

	// 上传字符串到七牛
	public function putString($key, $string)
	{
		$this->getUploadManager();
		list($ret, $err) = $this->uploadManager->put($this->token, $key, $string);
		//echo "\n====> put result: \n";
		if ($err !== null) {

			return array(
				'success'=>false,
				'data'=>$err
			);

		} else {
		    return array(
		    	'success'=>true,
		    	'data'=>$ret
		    );
		}
	}


	// 上传本地文件到七牛
	public function putFile($key, $filePath)
	{
		
		// $filePath = './php-logo.png';
		// $key = 'php-logo.png';
		$this->getUploadManager();
		list($ret, $err) = $this->uploadManager->putFile($this->token, $key, $filePath);
		//echo "\n====> putFile result: \n";
		if ($err !== null) {
			return array(
				'success'=>false,
				'data'=>$err
			);

		} else {
		    return array(
		    	'success'=>true,
		    	'data'=>$ret
		    );
		}
	}

	/**
	 *上传网络文件
	 */
	public function fetchFile($key, $url)
	{
		$this->getBucketManager();
		list($ret, $err) = $this->bucketManager->fetch($url, $this->bucket, $key);
		//echo "=====> fetch $url to bucket: $bucket  key: $key\n";
		if ($err !== null) {

			return array(
				'success'=>false,
				'data'=>$err
			);

		} else {
		    return array(
		    	'success'=>true,
		    	'data'=>$ret
		    );
		}	
	}

	public function getFilePath($key)
	{
		if(strpos($key, '/')== 0)
		{
			return $this->domain.'/@'.$key;
		}
		else
		{
			return $this->domain.$key;
		}
		
	}




	/**
	 *根据key查寻文件信息
	 */
	public function fileStat($key)
	{
		$this->getBucketManager();
		return $this->bucketManager->stat($this->bucket, $key);
	}

	/**
	 *
	 */
	public function fileExists($key)
	{
		if($this->fileStat($key)[0] == null)
		{
			return false;
		}
		return true;
	}

	//将文件从文件$key 复制到文件$key2。 可以在不同bucket复制
	public function copy($bucket, $key, $bucket2, $key2)
	{

		$err = $this->getBucketManager()->copy($bucket, $key, $bucket2, $key2);
		// echo "\n====> copy $key to $key2 : \n";
		if ($err !== null) {
		    return false;
		} else {
		   	return true;
		}
	}

	public function move($bucket, $key, $bucket2, $key2)
	{
		$err = $this->getBucketManager()->move($bucket, $key, $bucket2, $key2);
		// echo "\n====> move $key2 to $key3 : \n";
		if ($err !== null) {
		    return false;
		} else {
		    return true;
		}
	}

	public function delete($key)
	{
		$this->getBucketManager();
		$err = $this->bucketManager->delete($this->bucket, $key);
		// echo "\n====> delete $key3 : \n";
		if ($err !== null) {
		    return false;
		} else {
		    return true;
		}
	}

}


?>