<?php
class UtilHtml
{
	/**
	 * 把关键字高亮显示
	 * @param string $string
	 * @param string $subject
	 */
	public static function highlight($string,$subject)
	{
		return preg_replace("/$string/i", "<font color=\"yellow\"><b>$string</b></font>", $subject);
	}
	
	public static function SearchString($string)
	{
		$delimiter = array(' ',' and ',' or ', '+',':');
		
		foreach ($delimiter as $k=>$v)
		{
			if (strpos($v, $string))
			{
				$result[] = explode($v, $string);
			}
			
		}
		
		return $result;
		
		
	}
}