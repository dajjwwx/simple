<?php
class UtilFileInfo
{
	public static function getMimeType($filename)
	{
		
		if (substr($filename, 0, 1) == '.' || substr($filename, 0, 1) == '/')
		{
			$mime = CFileHelper::getMimeType($filename);
		}
		elseif (substr($filename, 0, 4)== 'http')
		{
			$info = get_headers($filename, true);
			
			$mime = $info['Content-Type'];
			
		}
		
		return $mime;
		
	}

	/**
	 * 格式化空间
	 * @param int $size
	 */
	public static function formatSize($size) 
	{
	      $sizes = array(" Bytes", " KB", " MB", " GB", " TB", " PB", " EB", " ZB", " YB");
	      if ($size == 0) 
	      { 
	      	return('n/a'); 
	      } 
	      else 
	      {
	      	return (round($size/pow(1024, ($i = floor(log($size, 1024)))), 2) . $sizes[$i]); 
	      }
	}
	
}
?>