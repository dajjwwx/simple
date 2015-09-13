<?php
class UtilAutoSave {
	
	private static function generateAutoSaveFileName()
	{
		return Yii::app()->user->name.'_'.date('Ymdhis');
	}
	
	public static function getAutoSaveFolder($userid, $isSavePath=true)
	{
		$filename =  Yii::app()->params->autoSavePath.$userid.'/';
		
		if ($isSavePath)
		{
			$filename = '.'.$filename;
		}
		
		return $filename;
	}
	
	/**
	 * 在main.php中配置用户自动保存目录
	 * @param unknown_type $userid
	 * @return string
	 */
	public static function getAutoSaveFileName($userid, $isSavePath=true)
	{
		$filename = self::getAutoSaveFolder($userid, $isSavePath).self::generateAutoSaveFileName().Yii::app()->params->autoSaveFileExtension;
		return $filename;		
		
	}
	
	//获取与当前信息相似的文件名
	public static function getSimilarFile($message){
			
		$dir = dir(dirname(self::getAutoSaveFileName(Yii::app()->user->id)));
		//	    echo "Handler:".$dir->handle."\n";
		//	   	echo "Path:".$dir->path."\n";
		while (false !== ($entry=$dir->read())) {
			if(!($entry=='.'||$entry=="..")){
				$path = $dir->path.'/'.$entry;
				if(file_exists($path)){
	
					//获取保存的文件内容
					$data = file_get_contents($path);
	
					//比较文件内容与信息，得出相似度
					$similar = UtilString::similarCompare($data,$message);
	
					$similarArr[] = $similar;
	
					if($similar>90){
						return $path;
					}	
				}
			}
		}
		
		UtilHelper::writeToFile($similarArr);
				
		return false;
		
	}
	
	/**
	 * 读取文件内容，并反序列化，输出数组
	 * @param unknown_type $filename
	 * @return mixed
	 */
	public function ReadAchive($filename)
	{
		$content = file_get_contents($filename);
		return unserialize($content);
	}
	
	
	//获取所有存档文件信息
	public static function getAllAchiveInfo()
	{
		$achiveInfo = array();
		$path = self::getAutoSaveFolder(Yii::app()->user->id, true);
				
		$dir = dir($path);
		$i = 0;
		while (false !== ($entry = $dir->read())) {
			if(!($entry == '.' || $entry == '..')){
				$file =  $dir->path.$entry;
				$achiveInfo[] =self::ReadAchive($file);
				$achiveInfo[$i]['Article']['id'] = substr($entry,0,strpos($entry, '.'));
				$i++;
			}
		}
			
		return $achiveInfo;
	}
	
	/**
	 * 把自动保存内容存入文件
	 * @param unknown_type $string
	 */
	public static function saveAsFile($string)
	{
		$similarfile = self::getSimilarFile($string);
		
		//如果获取到相似文件，则使用其文件名
		if ($similarfile)
		{
			$filename = $similarfile;
		}
		else
		{
			$filename = self::getAutoSaveFileName(Yii::app()->user->id);
		}		
		
		
		if (!file_exists($filename))
		{
			UtilHelper::createFolder(dirname($filename));
		}
		
		$file = fopen($filename, 'w+');
		fwrite($file, $string);
		fclose($file);
	}
	
}

?>