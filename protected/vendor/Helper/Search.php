<?php
/**
 * 文件: Search.php
 * 功能: 搜索指定目录下的HTML文件
 **********************************************************************************************************************************************************************************************************************************************************************
 *示例代码：
 * $dir = "./";
 * $keyword = "BookInfo";
 * $fileArr = Search::searchFile($dir, $keyword);
 * $searchSum = count($fileArr);
 * echo "搜索关键字: <b>$keyword</b> &nbsp; 搜索目录: <b>$dir</b> &nbsp; 搜索结果: <b>$searchSum</b><br><hr size=1><br>";
 * if ($searchSum <= 0) {
 *	 echo "没有搜索到任何结果";
 * } else {
 * foreach($fileArr as $file) {
 *		echo "<a href='$file' target='_blank'>".Search::highLightKeyword(getFileTitle($file), $keyword)."</a> - ".getFileSize($file)."&nbsp;".getFileTime($file)."<br>\n<font size=2>".highLightKeyword(getFileDescribe($file), $keyword)."</font><br><br>";
 *	 }
 * }
 ***************************************************************************************************************************************************************************************************************************************************************************************
 */

class Search
{
	//获取目录下文件函数
	public static function getFile($dir) 
	{
		$dp = opendir($dir);
		$fileArr = array();
		while (!false == $curFile = readdir($dp)) 
		{
			if ($curFile != "." && $curFile != ".." && $curFile != "") 
			{
				if (is_dir($curFile)) 
				{
					$fileArr = self::getFile($dir."/".$curFile);
				} 
				else 
				{
					$fileArr[] = $dir."/".$curFile;
				}
			}
		}
		return $fileArr;
	
	
	//获取文件内容
	public static function getFileContent($file) 
	{
		if (!$fp = fopen($file, "r")) 
		{
			die("Cannot open file $file");
		}
		while ($text = fread($fp, 4096)) 
		{
			$fileContent. = $text;
		}
		return $fileContent;
	}
	
	//搜索出文章的标题
	public static function searchText($file, $keyword) 
	{
		$text = self::getFileContent($file);
		if (preg_match("/$keyword/i", $text)) 
		{
			return true;
		}
		return false;
	}
	
	//搜索出文章的标题
	public static function getFileTitle($file, $default = "None subject") 
	{
		$fileContent = self::getFileContent($file);
		$sResult = preg_match("/<title>.*<\/title>/i", $fileContent, $matchResult);
		$title = preg_replace(array("/(<title>)/i", "/(<\/title>)/i"), "", $matchResult[0]);
		if (empty($title)) 
		{
			return $default;
		} 
		else 
		{
			return $title;
		}
	}
	
	//获取文件描述信息
	public static function getFileDescribe($file, $length = 200, $default = "None describe") 
	{
		$metas = get_meta_tags($file);
		if ($meta['description'] != "") 
		{
			return $metas['description'];
		}
		$fileContent = self::getFileContent($file);
		preg_match("/(<body.*<\/body>)/is", $fileContent, $matchResult);
		$pattern = array("/(<[^\x80-\xff]+>)/i", "/(<input.*>)+/i", "/(<a.*>)+/i", "/(<img.*>)+/i", "/([<script.*>])+.*([<\/script>])+/i", "/&amp;/i", "/&quot;/i", "/&#039;/i", "/\s/");
		$description = preg_replace($pattern, "", $matchResult[0]);
		$description = mb_substr($description, 0, $length)." ...";
		return $description;
	}

	//加亮搜索结果中的关键字
	public static function highLightKeyword($text, $keyword, $color = "#C60A00") 
	{
		$newword = "<font color=$color>$keyword</font>";
		$text = str_replace($keyword, $newword, $text);
		return $text;
	}
	
	//搜索目录下所有文件
	public static function getFileSize($file) 
	{
		$filesize = intval(filesize($file) / 1024)."K";
		return $filesize;
	}
	
	//获取文件最后修改的时间
	public static function getFileTime($file) 
	{
		$filetime = date("Y-m-d", filemtime($file));
		return $filetime;
	}
	
	//搜索目录下所有文件
	public static function searchFile($dir, $keyword) 
	{
		$sFile = self::getFile($dir);
		if (count($sFile) <= 0) 
		{
			return false;
		}
		$sResult = array();
		foreach($sFile as $file) 
		{
			if (self::searchText($file, $keyword)) 
			{
				$sResult[] = $file;
			}
		}
		if (count($sResult) <= 0) 
		{
			return false;
		} else {
			return $sResult;
		}
	}
}
?>